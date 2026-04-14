jQuery(document).ready(function() {
    jQuery('.hero-slider').owlCarousel({
        loop:false,
        margin:0,
        dots:true,
        nav:false,
        items: 1
    });
});

jQuery(document).ready(function ($) {
    AOS.init();

    $(".js-toggle-menu").bind("click", function (e) {
        e.preventDefault();
        $("html").toggleClass("mob-menu-open");
        $(this).toggleClass("is-active");
    });

    $(".js-toggle-submenu a").bind("click", function (e) {
        e.preventDefault();
        $("html").toggleClass("submenu-open");
    });

    $('.megamenu-dropdown-mobile').on('click', function() {
        $window_width = $(window).width();
        if($window_width < 768) {
            if(!$(this).hasClass('active')){
                $('.megamenu-dropdown-mobile.active').next('.megamenu__links').slideToggle(300);
                $('.megamenu-dropdown-mobile.active').next('.megamenu__links').toggleClass('active');
                $('.megamenu-dropdown-mobile.active').toggleClass('active');
                $(this).toggleClass('active');
                $(this).next('.megamenu__links').slideToggle(300);
                $(this).next('.megamenu__links').toggleClass('active');
            }else{
                $(this).toggleClass('active');
                $(this).next('.megamenu__links').slideToggle(300);
                $(this).next('.megamenu__links').toggleClass('active');
            }
        }
    });

    $('.footer-mobile-container .footer-widget-area .widget_nav_menu .menu>.menu-item.menu-item-has-children>.sub-menu>.menu-item>a').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $(this).next('.sub-menu').slideToggle(300);
        $(this).next('.sub-menu').toggleClass('active');
    });
    $('body').on('click', '.open-hidden', function(event) {
        event.preventDefault();
        $(this).toggleClass('active');
        $(this).parent().parent().next('.product-table-row-hidden').slideToggle(300);
        $(this).parent().parent().next('.product-table-row-hidden').toggleClass('active');
    });
});