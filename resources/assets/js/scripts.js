/*
* ----------------------------------------------------------------------------------------
Author       : Onepageboss
Template Name: Apolo - Onepage Creative Business Template
Version      : 1.0                                          
* ----------------------------------------------------------------------------------------
*/

(function ($) {
    'use strict';

    jQuery(document).ready(
        function () {

            /*
            * ----------------------------------------------------------------------------------------
            *  PRELOADER JS
            * ----------------------------------------------------------------------------------------
            */
            $(window).load(
                function () {
                    $('.preloader').fadeOut();
                    $('.preloader-area').delay(350).fadeOut('slow');


                    /*
                    * ----------------------------------------------------------------------------------------
                    *  Carrega Acessorios
                    * ----------------------------------------------------------------------------------------
                    */
                    /*  ANALITICS */
                    (function (i,s,o,g,r,a,m) {
                        i['GoogleAnalyticsObject']=r;i[r]=i[r]||function () {
                                        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
                    ga('create', 'UA-47362374-2', 'auto');
                    ga('send', 'pageview');
                    /*  CHAT TAWK */
                    // var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
                    // (function(){
                    //     var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
                    //     s1.async=true;
                    //     s1.src='https://embed.tawk.to/58abbd9dff923c0ab4291731/default';
                    //     s1.charset='UTF-8';
                    //     s1.setAttribute('crossorigin','*');
                    //     s0.parentNode.insertBefore(s1,s0);
                    // })();
                    /*  CHAT ZENDESK */
                    window.$zopim||(function (d,s) {
                        var z=$zopim=function (c) {
                                    z._.push(c)},$=z.s=
                        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function (o) {
                            z.set.
                            _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
                        $.src="https://v2.zopim.com/?58VxK9eT5CjowtPfxm9TGJuOJWpN6JjZ";z.t=+new Date;$.
                        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
                    /*  Hotjar Tracking Code for www.ricasolucoes.com.br */
                    (function (h,o,t,j,a,r) {
                        h.hj=h.hj||function () {
                            (h.hj.q=h.hj.q||[]).push(arguments)};
                        h._hjSettings={hjid:523747,hjsv:5};
                        a=o.getElementsByTagName('head')[0];
                        r=o.createElement('script');r.async=1;
                        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                        a.appendChild(r);
                    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
                }
            );

            /*
            * ----------------------------------------------------------------------------------------
            *  CHANGE MENU BACKGROUND JS
            * ----------------------------------------------------------------------------------------
            */
            $(window).on(
                'scroll', function () {
                    if ($(window).scrollTop() > 200) {
                        $('.header-top-area').addClass('menu-bg');
                    } else {
                        $('.header-top-area').removeClass('menu-bg');
                    }
                }
            );


            /*
            * ----------------------------------------------------------------------------------------
            *  PROGRESS BAR JS
            * ----------------------------------------------------------------------------------------
            */
            $('.progress-bar > span').each(
                function () {
                    var $this = $(this);
                    var width = $(this).data('percent');
                    $this.css(
                        {
                            'transition': 'width 3s'
                        }
                    );
                    setTimeout(
                        function () {
                            $this.appear(
                                function () {
                                    $this.css('width', width + '%');
                                }
                            );
                        }, 500
                    );
                }
            );


            /*
            * ----------------------------------------------------------------------------------------
            *  SMOTH SCROOL JS
            * ----------------------------------------------------------------------------------------
            */

            $('a.smoth-scroll').on(
                "click", function (e) {
                    var anchor = $(this);
                    var divTarget = anchor.attr('href').split('#');
                    $('html, body').stop().animate(
                        {
                            scrollTop: $('#'+divTarget[1]).offset().top - 50
                        }, 1000
                    );
                    e.preventDefault();
                }
            );

            /*
            * ----------------------------------------------------------------------------------------
            *  WORK JS
            * ----------------------------------------------------------------------------------------
            */

            $('.work-inner').mixItUp();

            /*
            * ----------------------------------------------------------------------------------------
            *  MAGNIFIC POPUP JS
            * ----------------------------------------------------------------------------------------
            */

            $('.work-popup').magnificPopup(
                {
                    type: 'image',
                    gallery: {
                        enabled: true
                    }

                }
            );
            /*
            * ----------------------------------------------------------------------------------------
            *  PARALLAX JS
            * ----------------------------------------------------------------------------------------
            */

            $(window).stellar(
                {
                    responsive: true,
                    positionProperty: 'position',
                    horizontalScrolling: false
                }
            );

            /*
            * ----------------------------------------------------------------------------------------
            *  COUNTER UP JS
            * ----------------------------------------------------------------------------------------
            */

            $('.counter-num').counterUp();


            /*
            * ----------------------------------------------------------------------------------------
            *  TESTIMONIAL JS
            * ----------------------------------------------------------------------------------------
            */

            $(".testimonial-list").owlCarousel(
                {
                    items: 1,
                    autoPlay: true,
                    navigation: false,
                    itemsDesktop: [1199, 1],
                    itemsDesktopSmall: [980, 1],
                    itemsTablet: [768, 1],
                    itemsTabletSmall: false,
                    itemsMobile: [479, 1],
                    pagination: true,
                    autoHeight: true,
                }
            );


            /*
            * ----------------------------------------------------------------------------------------
            *  EXTRA JS
            * ----------------------------------------------------------------------------------------
            */
            $(document).on(
                'click', '.navbar-collapse.in', function (e) {
                    if ($(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle') {
                        $(this).collapse('hide');
                    }
                }
            );
            $('body').scrollspy(
                {
                    target: '.navbar-collapse',
                    offset: 195
                }
            );

            /*
            * ----------------------------------------------------------------------------------------
            *  SCROOL TO UP JS
            * ----------------------------------------------------------------------------------------
            */
            $(window).scroll(
                function () {
                    if ($(this).scrollTop() > 250) {
                        $('.scrollup').fadeIn();
                    } else {
                        $('.scrollup').fadeOut();
                    }
                }
            );
            $('.scrollup').on(
                "click", function () {
                    $("html, body").animate(
                        {
                            scrollTop: 0
                        }, 800
                    );
                    return false;
                }
            );

            /*
            * ----------------------------------------------------------------------------------------
            *  WOW JS
            * ----------------------------------------------------------------------------------------
            */
            new WOW().init();

        }
    );

})(jQuery);