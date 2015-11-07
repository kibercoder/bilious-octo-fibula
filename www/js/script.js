$(function(){

$('div.slider-big').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	dots: true
});

$('div.comment').slick({
	slidesToShow: 2,
	slidesToScroll: 2
});

$('div.prod').slick({
	infinite: true,
	slidesToShow: 2,
	slidesToScroll: 2,
	dots: true
});

$('div.multiple-items3, div.spec').slick({
	slidesToShow: 3,
	slidesToScroll: 1
});

/* main_menu */
//$("div.login div.show").hide();
$("div.login a.enter").click(function(){
	//$(this).toggleClass("sel").parent("#menu_more").next("#menu_list").stop(true,true).slideToggle();
	$("div.login div.show").toggle();
	return false;
});
$("section").click(function(){
		$("div.login div.show").hide();
});
/* /main_menu */

/* find */
//$("section.find").hide();
//$("header div.search a").click(function(){
	//$(this).toggleClass("sel").parent("#menu_more").next("#menu_list").stop(true,true).slideToggle();
	//$("section.find").toggle();
	//return false;
//});

/* /find */

/* add-find */
//$("div.add-find").hide();
$("div.find-block a.add").click(function(){
	//$(this).toggleClass("sel").parent("#menu_more").next("#menu_list").stop(true,true).slideToggle();
	$("div.add-find").toggle();
	return false;
});

/* /add-find */

var getPriceMin = parseInt($('.add-find input[name=price_min]').val());

var getPriceMax = parseInt($('.add-find input[name=price_max]').val());

var default_min = (getPriceMin > 0) ? getPriceMin : 1000;

var default_max = (getPriceMax > 0) ? getPriceMax : 50000;

/* slider-range */
$( "#slider-range" ).slider({
      range: true,
      min: 1000,
      max: 500000,
      values: [ default_min, default_max ],
      slide: function( event, ui ) {

        $('.add-find input[name=price_min]').val(ui.values[ 0 ]);
        $('.add-find input[name=price_max]').val(ui.values[ 1 ]);

        $( "#slider-range span" ).eq("0").html( "<b>" + ui.values[ 0 ] + "</b>");
		$( "#slider-range span" ).eq("1").html( "<b>" + ui.values[ 1 ] + "</b>");
      }
    });

    $('.add-find input[name=price_min]').val(default_min);
    $('.add-find input[name=price_max]').val(default_max);

    $( "#slider-range span" ).eq("0").html( "<b>" +  $( "#slider-range" ).slider( "values", 0 ) + "</b>");
	$( "#slider-range span" ).eq("1").html( "<b>" +  $( "#slider-range" ).slider( "values", 1 ) + "</b>");
/* /slider-range */


//$("div.search a").click(function(){
	//$(this).toggleClass("sel").parent("#menu_more").next("#menu_list").stop(true,true).slideToggle();
	//$("section.find").toggle();
	//return false;
//});


var body = $('html, body');
$('div.up a').click( function(){
    body.animate({scrollTop:0}, '500', 'swing');
    return false;
});

$('[data-function="pay_step1"]').click(function(){
    $(this).hide();
    $('.product_buy_card').show();
    return false;
});

//*Отправляем наш заказ*//
$('[data-function="pay_step2"]').click(function(){

    // Получаем URL текущей страницы.
    var href=window.location.href;
    // Получаем домен сайта и прибавлем ему протокол http://
    var str = "http://"+document.domain;
    //Узнаём длину str
    var str2 = str.toString().length;
    //Обрезаем URL текущей строки и получаем относительный путь для отправки на него Ajax запроса
    var uri = href.substring(str2);

    var card_number = Trim($('input#card_number').val());
    var card_name = Trim($('input#card_name').val());
    var card_term = Trim($('input#card_term').val());
    var card_code = parseInt(Trim($('input#card_code').val()));

    /*1234-1234-1234-1234*/
    var reg_number = /[0-9-\s]{16,19}/i;
    var number = card_number.match(reg_number);

    if (card_number==number
        && card_name.toString().length>3
        && card_term.isDateStr()
        && card_code.toString().length>=3
        && !isNaN(card_code)){

        $('.product_buy_card input').removeAttr('style');

        data = new Object();
            data['card_number'] = card_number;
            data['card_term'] = card_term;
            data['card_name'] = card_name;
            data['card_code'] = card_code;

            $.ajax({
              type:'POST',
              url:uri,
              data: data,
              beforeSend: function(){

              },
              ajaxError: function(){
                  alert('Ошибка - попробуйте ещё раз!');
              },
              success: function(result){
                  if (result=='true') {
                    $('.product_buy_card').hide();
                    $('.thanx_block').show();
                  }
                  else alert('Заказ не оформлен - попробуйте ещё раз!');
              }
            });


    } else {

        if (card_number!=number) $('input#card_number').css('border-color','#000').css('color','#FF0000');
        else $('input#card_number').removeAttr('style');

        if (card_name.toString().length <= 3) $('input#card_name').css('border-color','#000').css('color','#FF0000');
        else $('input#card_name').removeAttr('style');

        if (!card_term.isDateStr()) $('input#card_term').css('border-color','#000').css('color','#FF0000');

        else $('input#card_term').removeAttr('style');

        if (card_code.toString().length>=3 || isNaN(card_code)) $('input#card_code').css('border-color','#000').css('color','#FF0000');

        else $('input#card_code').removeAttr('style');

    }

    return false;

});




});

function Trim(s) {
    s = s.replace(/^ +/,'');
    s = s.replace(/ +$/,'');
    return s;
}

String.prototype.isDateStr=function()
// проверяет, является ли строка s датой в формате DD.MM.YYYY
// --------------------------------------------------------------
{
	var r=/^(\d{2})\.(\d{2})\.(\d{4})$/;
	if (r.test(this))
	{
		var d=RegExp.$1*1; var m=RegExp.$2*1; var y=RegExp.$3*1;
		var test=new Date(y,m-1,d);
		return (test.getFullYear()==y && test.getMonth()==m-1 && test.getDate()==d);
	}
	else
		return false;
}
