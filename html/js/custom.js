(function ($) {
    $(document).ready(function () {
        // Testimonials slider js
        $('.testimonials-slider').slick({
            dots: false,
            infinite: true,
            slidesToScroll: 1,
            slidesToShow: 1,
            swipe: true,
            arrows: false,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 1200,
            fade: true,
        });
    });
    
    // Hamburger Menu 

    $("header .header-wrap .fa-bars").click(function(){
        $('header .header-menu-links').addClass('toggle').slideToggle();
        $('header .header-wrap .fa-times').show();
        $('header .header-wrap .fa-bars').hide();
    });
    $(".fa-times").click(function(){
        $('header .header-menu-links').removeClass('toggle').slideToggle();
        $('header .header-wrap .fa-times').hide();
        $('header .header-wrap .fa-bars').show();
    });

    // On Resize Hamburger Menu            
    $(window).on("load resize",function(e){
        var $width = $(this).width();
        if ($width < 767) {
                if($('header .header-menu-links').hasClass('toggle')) {
                    $('header .header-menu-links').css({'display': 'block'});
                } else {
                    $('header .header-menu-links').css({'display': 'none'});
                }                        
        } else {
            $('header .header-menu-links').css({'display': 'flex'});
        }
    });
})(jQuery);