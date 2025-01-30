/*global $, alert, console */

$(function () {

    'use strict';
    var usererror = true , emailerror = true , numbererror = true , msgerror = true ;

     


    $('.user-name').blur(function () {
     'use strict';


        if ($(this).val().length < 3) {

             $(this).css('border', '1px solid #f00');

             $(this).parent().find('.alert').fadeIn(100);

             $(this).parent().find('.asterisx').fadeIn(200);

             usererror = true ;


        } else {

             $(this).css('border' , '1px solid #00FF00');
            $(this).parent().find('.custom-alert').fadeOut(100);
            $(this).parent().find('.asterisx').fadeOut(200);


            usererror = false ;

       }


    });


 
    $('.phone-number').blur(function(){

      if($(this).val().length < 11) {

           $(this).css('border','1px solid #f00 ');
           $(this).parent().find('.custom-alert').fadeIn(200);
           $(this).parent().find('.asterisx').fadeIn(200);
           numbererror = true ;

    }else{

         $(this).css('border' , '1px solid #00FF00');
           $(this).parent().find('.custom-alert').fadeOut(200);
           $(this).parent().find('.asterisx').fadeOut(200);

           numbererror = false ;

       }


     });


    $('.email').blur(function(){

      if($(this).val() === '') {

           $(this).css('border','1px solid #f00 ');
           $(this).parent().find('.custom-alert').fadeIn(200);
           $(this).parent().find('.asterisx').fadeIn(200);
           emailerror = true ;

    }else{

         $(this).css('border' , '1px solid #00FF00');
           $(this).parent().find('.custom-alert').fadeOut(200);
           $(this).parent().find('.asterisx').fadeOut(200);

           emailerror = false ;

       }


     });


    $('.text-area').blur(function(){

      if($(this).val().length < 10) {

           $(this).css('border','1px solid #f00 ');
           $(this).parent().find('.custom-alert').fadeIn(200);
           $(this).parent().find('.asterisx').fadeIn(200);
           msgerror = true;

    }else{

         $(this).css('border' , '1px solid #00FF00');
           $(this).parent().find('.custom-alert').fadeOut(200);
           $(this).parent().find('.asterisx').fadeOut(200);

          msgerror = false ;
       }


     });
     $('.contactform').submit(function(e) {


          if(usererror === true || emailerror === true || numbererror === true || msgerror === true )
          {
               e.preventDefault();
               $('.user-name, .phone-number, .email, .text-area').blur();
          }
          else {

               $(this).parent().find('.done-alert').fadeIn(200);

          }
     
     
     
     });
});



