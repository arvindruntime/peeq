"use strict";

(function ($) {
  var office_base_js = {
    __init: function __init() {
      // var self_obj = this;
      // office_base_js.AIO_reload();
      $(document).ready(this.initialize_ele); // $(window).load(this.onload_function);
      // $(document).on('click', '.btn', this.btn_click_event);
    },
    initialize_ele: function initialize_ele() {
      console.log("Ready");
      office_base_js.swiper_slider();
      office_base_js.Sticky_header();
      office_base_js.swiper_slider_hero();
    },
    // Mobile View Submenu JS
    Sub_menu: function Sub_menu() {
      jQuery(document).ready(function () {
        $('.menu-item-has-children a').click(function () {
          // if ($(window).width() < 1200) {
          $(this).siblings().toggleClass("show"); // }
        });
      });
    },
    swiper_slider: function swiper_slider() {
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false
        }
      });
    },
    swiper_slider_hero: function swiper_slider_hero() {
      var swiper = new Swiper(".mySwiper-hero", {
        slidesPerView: "1",
        // centeredSlides: true,
        effect: "fade",
        spaceBetween: 0,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true
        },
        autoplay: {
          delay: 3000,
          disableOnInteraction: false
        }
      });
    },
    // Sticky header
    Sticky_header: function Sticky_header() {
      $(window).scroll(function () {
        if ($(window).scrollTop() >= 40) {
          $('header').addClass('fixed-header');
        } else {
          $('header').removeClass('fixed-header');
        }
      });
    }
  };

  office_base_js.__init();
})(jQuery);