( function( $ ) {

    'use strict';

    jQuery(document).ready(function() {

        /*
        =============================================
        = Init Retina js
        =============================================
        */

        retinajs();

        /*
        =============================================
        = Init Primary navigation
        =============================================
        */

        jQuery('.primary-navigation').stellarNav({
            theme: 'dark',
            breakpoint: 991,
            closeBtn: false,
            scrollbarFix: true,
            sticky: false,
        });
        jQuery(".primary-navigation > ul").append('<li class="primarynav_search_icon"><a class="search_box" href="javascript:;"><i class="fa fa-search" aria-hidden="true"></i></a></li>');

        /*
        =============================================
        = Search box toggle 
        =============================================
        */

        jQuery(".search_box").click(function() {

            jQuery(".header-search-container").toggle();

        });

        /*
        =============================================
        = Init match height
        =============================================
        */

        jQuery('.watchheight').matchHeight();

        /*
        =============================================
        = Init Sticky sidebar
        =============================================
        */

        jQuery('.sticky_portion').theiaStickySidebar({
            
            additionalMarginTop: 10,
        });


        /*
        ================================================
        = Init selectric for drop downs ( select )
        ================================================
        */


        $('.orderby').selectric(); 



        /*
        =============================================
        = Breaking news carousel
        =============================================
        */

        jQuery('.ticker_carousel').owlCarousel({
            
            items: 1,
            loop: true,
            margin: 0,
            smartSpeed: 4000,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            mouseDrag: false,
            touchDrag: false,
            animateOut: 'slideOutUp',
            animateIn: 'slideInUp',
            navText: ["<i class='feather icon-chevron-down'></i>", "<i class='feather icon-chevron-up'></i>"],
        });

        /*
        =============================================
        = Init Main slider/banner posts carousel
        =============================================
        */

        // Banner layout 5

        jQuery('.cm_banner-carousel-five').owlCarousel({
            items: 1,
            loop: true,
            lazyLoad: false,
            margin: 0,
            smartSpeed: 800,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        });


        // Middle Widget Six Carousel Init

        jQuery('.middle_widget_six_carousel').owlCarousel({
            items: 2,
            loop: true,
            margin: 30,
            lazyLoad: true,
            smartSpeed: 800,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 8000,
            autoplayHoverPause: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                400: {
                    items: 1
                },
                576: {
                    items: 2,
                    margin: 15,
                },
                768: {
                    items: 2,
                    margin: 15,
                },
                992: {
                    items: 2
                },
                1024: {

                    items: 2
                },
                1200: {
                    items: 2
                }
            },
        });


        /*
        =============================================
        = Append back to top button
        =============================================
        */


        jQuery('body').append('<div id="toTop" class="btn btn-info"><i class="fa fa-angle-up" aria-hidden="true"></i></div>');
        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() != 0) {
                jQuery('#toTop').fadeIn();
            } else {
                jQuery('#toTop').fadeOut();
            }
        });
        jQuery('#toTop').click(function() {
            jQuery("html, body").animate({ scrollTop: 0 }, 800);
            return false;
        });



        /*
        =============================================
        = Lazy Load Initialization
        =============================================
        */

        var lazy = function lazy() {
            document.addEventListener('lazyloaded', function(e) {
                e.target.parentNode.classList.add('image-loaded');
                $.when().done(function(){var cloele = $('.lazy-thumb');
                cloele.removeClass('lazyloading');});
            });
        }

        lazy();

        window.lazySizesConfig = window.lazySizesConfig || {};

        lazySizesConfig.preloadAfterLoad = false;
        lazySizesConfig.expandChild = 370;


    });
} ) ( jQuery );