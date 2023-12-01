
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



$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
jQuery(document).on('click','#bt-new-user', function(e) {

    e.preventDefault(); 

    var data = jQuery("#rsUserRegistration").serialize();
    var firstname = jQuery('#vb_firstname').val();
    var lastname = jQuery('#vb_lastname').val();
    var email = jQuery('#vb_email').val();
    var phone = jQuery('#vb_phone').val();
    // var upload = jQuery('.file-upload').val();

    $(".error").remove();
    if (firstname.length < 1) {
        $('#vb_firstname').after('<span class="error">This field is required</span>');
    }
    if (lastname.length < 1) {
        $('#vb_lastname').after('<span class="error">This field is required</span>');
    }
     if (email.length < 1) {  
        $('#vb_email').after('<span class="error">This field is required</span>');  
    } else {  
        var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;  
        var validEmail = regEx.test(email);  
        if (!validEmail) {  
            $('#vb_email').after('<span class="error">Enter a valid email</span>');  
        }  
    } 
    if (phone.length < 10) {
        $('#vb_phone').after('<span class="error">This field is required</span>');
    } 

    var aFormData = new FormData(jQuery("#rsUserRegistration")[0]);
        aFormData.append("file-upload", $('#file-upload')[0].files[0]);
    jQuery.ajax({
        type: 'POST',
        url: ajax_posts.ajaxurl,
        data: aFormData,
        processData: false,
        contentType: false,
        success: function(res) {  
            window.location.href = window.location.href;
            // setInterval('autoRefreshPage()', 1000);               
        }
        // e.preventDefault();
  
    });  
    
});

