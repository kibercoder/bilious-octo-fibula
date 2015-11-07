$(function(){
    
    $('.login div button').click(function(){
      
        var data;

        var username = Trim($('#your_username').val());
        var pass = Trim($('#your_pass').val());
        var reg_email = /[0-9a-z_]+@[0-9a-z_]+\.[a-z]{2,5}/i;
        var email = username.match(reg_email);

        if (username==email && pass.toString().length>5){
            
            $('#your_username, #your_pass').removeAttr('style');

            /*data = new Object();
            data['LoginForm[password]'] = pass;
            data['LoginForm[username]'] = username;
            data['LoginForm[rememberMe]'] = 1;
            data['LoginForm[js]'] = 'yes';
            
            $.ajax({
              type:'POST',
              url:'/login',
              data: data,
              beforeSend: function(){
                  
              },
              ajaxError: function(){
                  alert('Ошибка - попробуйте ещё раз!');
              },
              success: function(result){

                  if (result=='true') window.history.go();
                  else alert('Не правильный логин или пароль!');
              }
            });*/
            
        } else {
          
            if (username!=email) $('#your_username').css('border-color','#FF0000').css('color','#FF0000');
            else $('#your_username').removeAttr('style');
            
            if (pass.toString().length <= 5) $('#your_pass').css('border-color','#FF0000').css('color','#FF0000');
            else $('#your_pass').removeAttr('style');
            return false;
          
        }

    });
    

});

function Trim(s) {
    s = s.replace(/^ +/,'');
    s = s.replace(/ +$/,'');
    return s;
}