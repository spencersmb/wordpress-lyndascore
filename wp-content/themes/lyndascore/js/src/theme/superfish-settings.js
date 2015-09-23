/*
 * CUSTOM SUPERFISH MENU
 */

( function( $ ) {

    var breakpoint = 991;
    var sf = $('ul.nav-menu');

    //use superfish if larger than mobile on document.load
    if($(document).width() >= breakpoint){

        sf.superfish({
            delay:200,
            speed: 'fast'
        });

    }

    //on resize do this
    $(window).resize(function () {
       if($(document).width() >= breakpoint && !sf.hasClass('sf-js-enabled')){
           sf.superfish({
               delay:200,
               speed: 'fast'
           });
       } else if($(document).width() < breakpoint){
           sf.superfish('destroy');


       }
    });

} )( jQuery );

