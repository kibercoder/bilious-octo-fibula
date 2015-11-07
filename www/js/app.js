


/** Калькулятор **/
$(function(){

    var $form = $('#calculator');
    var $finalSum = $form.find('.final_sum');

    var doFormat = function(value){
        return accounting.formatMoney( value , "", 0, " ", ",")
    }

    var unFormat = function(value){
        return accounting.unformat( value )
    }

    var doCalc = function(){

        var sum = parseInt( unFormat($sumValue.val()) );
        var month = $monthValue.val();
        var result = sum + sum * 0.16 / month;

        return Math.round( result );
    }

    var $sumValue = $form.find('.sum_value');

    $form.find('.slider-line--sum').slider({
      orientation: "horizontal",
      range: "min",
      animate: true,
      min: 30,
      max: 10000,
      step: 10,
      slide: function( event, ui ) {
          $sumValue.val( doFormat( ui.value * 1000) );
          $finalSum.text(doFormat(doCalc()));
      }
    });

    var $monthValue = $form.find('.month_value');
    $form.find('.slider-line--month').slider({
      orientation: "horizontal",
      range: "min",
      animate: true,
      min: 1,
      max: 12,
      step: 1,
      slide: function( event, ui ) {
          $monthValue.val(ui.value);
          $finalSum.text(doFormat(doCalc()));
      }
    });

    var $label = $('.curr_type_label');
    $form.find('.curr-selector')
      .buttonset()
      .on('change', function(){
          var sel = $(this).find('input:radio[name=currency_type]:checked').val();
          var text = 'рубли';

          switch(sel){
              case 'usd': text = 'доллары'; break;
              case 'eur': text = 'евро'; break;
          }

          $label.text(text);
      });
});


/** Форма */

$(function(){
    $( "#checkbox-personal-data" ).button();
});

/** Анимация элементов */
$(function(){

  if( detectIE() ){
    return;
  }

  if( $('.block3').length == 0 || $('.block5').length == 0 ){
    return;
  }

  // list1
  var $itemList = $('.block3').find('.items_block').find('.item');
  var offset = $('.block4').offset();
  var fired = false;
  $itemList.velocity({scaleX: 1.4, scaleY: 1.4, opacity:0}, 1);

  // list2
  var $itemList2 = $('.block5').find('.items_block').find('.item');
  var $lineList2 = $('.block5').find('.items_block').find('.line');
  var offset2 = $('.block6').offset();
  var fired2 = false;
  $itemList2.velocity({scaleX: 1.4, scaleY: 1.4, opacity:0}, 1);
  $lineList2.css({opacity:0});

  var doAnimation = function($list, effect, duration, delay){

      // анимация
      var count = $list.length;
      var delayTime = 0;

      $list.each(function(){

          $(this).velocity(effect, {
              /* Velocity's default options */
              duration: duration,
              easing: "ease",
              loop: false,
              delay: delayTime,
              mobileHA: true
          });

          delayTime += delay;
      });

  }

  $(window).scroll({x:0, y:0}, function(e){

      var top = this.scrollY;

      if( !fired && top >= ( offset.top - $(window).height() ) ){
          fired = true;
          doAnimation($itemList, {scaleX: 1, scaleY: 1, opacity:1}, 1000, 200);
      }

      if( !fired2 && top >= ( offset2.top - $(window).height() ) ){
          fired2 = true;
          doAnimation($itemList2, {scaleX: 1, scaleY: 1, opacity:1}, 1000, 200);
          doAnimation($lineList2, {opacity:1}, 3000, 500);
      }


  });


});

/**
 * Slider
 */

$( function(){

     $(".slick-slider").each( function(){

        var $slider = $(this);
        var $container = $slider.find(".slick-slider__list");

        //console.log( $container.length );

        $container.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            //infinite: true,
            speed: 500,
            fade: true,
            //cssEase: 'linear'
        });

        $slider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            var $slider = $(this);
            var $block = $slider.parents('.block');
            $block.find('[data-slider-class]').removeClass('active');
            $block.find('[data-slider-index="'+ nextSlide +'"]').addClass('active');

        });

    });

    $(document).on('click', '[data-slider-class]', function(){

        var $link = $(this);
        var sliderClass = $link.attr('data-slider-class');
        var $slider = $('.' + sliderClass);
        var index = $link.attr('data-slider-index');

        $('[data-slider-class='+ sliderClass +']').removeClass('active');
        $link.addClass('active');
        $slider.slick('slickGoTo', index);

        return false;
    });

});

/**
 * Переход к открытию вклада
 */
var gotoPage  = function(selector){

    console.log( selector );

    var offset = $(selector).offset();
    var headHeight = $('.block.header').height();

    $('html, body').stop().animate({
        scrollTop: offset.top - headHeight
    }, 500);

    return false;
}

/**
 * Переход по хешу
 */
//$(document).on('click', '[data-goto]', function(){
//    var selector = $(this).attr('data-goto');
//    gotoPage('.' + selector);
//});

$(function(){
    $(window).hashchange({ hash: "#1", onSet: function(){ gotoPage('.block1'); } });
    $(window).hashchange({ hash: "#2", onSet: function(){ gotoPage('.block2'); } });
    $(window).hashchange({ hash: "#3", onSet: function(){ gotoPage('.block3'); } });
    $(window).hashchange({ hash: "#4", onSet: function(){ gotoPage('.block4'); } });
    $(window).hashchange({ hash: "#5", onSet: function(){ gotoPage('.block5'); } });
    $(window).hashchange({ hash: "#6", onSet: function(){ gotoPage('.block6'); } });
})


/**
 * Анимация при открытии страницы
 */
$(function(){

  var $block = $('.block1');

  var $title1 = $block.find('.title1');
  var $title2 = $block.find('.title2');
  var $title3 = $block.find('.title3');

  $title3
      .css('top', '-500px')
      .show()
      .velocity({ 'top': '0px' }, { duration: 1500, delay: 1000 });

  $title2
      .css('top', '-500px')
      .show()
      .velocity({ 'top': '0px' }, { duration: 1500, delay: 500 });

  $title1
      .css('top', '-500px')
      .show()
      .velocity({ 'top': '0px' }, { duration: 1500, delay: 0 });
      ;

})

/**
 * Активный пункт меню
 */
 $(function(){

  var blockOffset = [
    $('.block1').offset(),
    $('.block2').offset(),
    $('.block3').offset(),
    $('.block4').offset(),
    $('.block5').offset(),
    $('.block6').offset(),
  ]

  var headHeight = $('.block.header').height();
  var $menu = $('.block.header').find('ul.menu li');

   $(window).scroll({x:0, y:0}, function(e){

      var top = this.scrollY;

      for( i=5;i>=0;i-- ){
          if( top >= (blockOffset[i].top - headHeight)  ){
              $menu.removeClass('active');
              $menu.eq(i).addClass('active');
              break;
          }
      }
  });

});

/**
 * Открытие попапов
 */
$(document).on('click', '[data-popup]', function(){
    var selector = $(this).attr('data-popup');
    $('.'+selector).show();
    return false;
});

$(document).on('click', '.popup .close, .popup .bg', function(){
    $(this).parents('.popup').hide();
    return false;
})

/**
 * Кастомный скролл для попапов отзывов
 */
$(function(){
    $('.scroll-pane').each(function(){
        $(this). jScrollPane({
            contentWidth: '0px',
            verticalDragMinHeight: 50,
            verticalDragMaxHeight: 50,
            horizontalDragMinWidth: 20,
            horizontalDragMaxWidth: 20
        });
    });
    $('.rev_popup').hide();
});

/**
 * Tooltip
 */
$(function() {

    $( '[data-tooltip]' ).each( function(){
        $(this).tooltip({
            position: { my: "center top+15", at: "center bottom" }
        });
        $(this).on('click', function(){
            return false;
        });
    });
})

/**
 * Open account form
 */

$(function(){

    var $form = $('.account_open_form');
    var $submit = $form.find('.do_account_open');

    // fields
    var $accountSum = $form.find('[name="account_sum"]');
    var $accountMonth = $form.find('[name="account_month"]');
    var $accountName = $form.find('[name="account_name"]');
    var $accountPhone = $form.find('[name="account_phone"]');

    var $accountNameError = $form.find('.account_name_error');
    var $accountPhoneError = $form.find('.account_phone_error');
    var $checkboxPersonal = $form.find('#checkbox-personal-data');

    $accountPhone.mask('+9(999)999-99-99');

    $submit.on('click', function(){

        var submit = true;

        $accountNameError.hide();
        $accountPhoneError.hide();

        if( $accountName.val().length == 0 ){
            $accountNameError.show();
            submit = false;
        }

        if( $accountPhone.val().length == 0 ){
            $accountPhoneError.show();
            submit = false;
        }

        if( $checkboxPersonal.filter(':checked').length == 0 ){
            submit = false;
        }

        if( submit ){
            $form.submit();
        }

        return false;
    });
});



/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf('MSIE ');
  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
  }

  var trident = ua.indexOf('Trident/');
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:');
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // IE 12 => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
  }

	// other browser
  return false;
}
