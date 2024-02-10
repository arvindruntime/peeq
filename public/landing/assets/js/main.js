(function($) {
  var office_base_js = {
    __init: function() {
      // var self_obj = this;
      // office_base_js.AIO_reload();
      $(document).ready(this.initialize_ele);
      // $(window).load(this.onload_function);
      // $(document).on('click', '.btn', this.btn_click_event);
    },
    initialize_ele: function() {
      console.log("Ready");
      office_base_js.swiper_slider();
      office_base_js.Sticky_header();
      office_base_js.swiper_slider_hero();
      office_base_js.flipper();
      office_base_js.In_SVG();

    },

   
    // Mobile View Submenu JS
    Sub_menu: function() {
      jQuery(document).ready(function() {
        $('.menu-item-has-children a').click(function() {
          // if ($(window).width() < 1200) {
          $(this).siblings().toggleClass("show");
          // }
        });
      });
    },

    swiper_slider: function() {
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 0,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        // autoplay: {
        //    delay: 2500,
        //    disableOnInteraction: false,
        //  },
        navigation: {
          nextEl: ".slider_next",
          prevEl: ".slider_prev",
        },
      });
    },
    swiper_slider_hero: function() {
      var swiper_hero = new Swiper(".mySwiper-hero", {
        slidesPerView: "1",
        effect: "fade",
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
      });
    },

    // Sticky header
    Sticky_header: function() {
      $(window).scroll(function() {
        if ($(window).scrollTop() >= 40) {
          $('header').addClass('fixed-header');
        } else {
          $('header').removeClass('fixed-header');
        }
      });
    },
    flipper: function(){
      var loginButton = document.getElementById("loginButton");
      var registerButton = document.getElementById("registerButton");
    
      loginButton.onclick = function () {
        document.querySelector("#flipper").classList.toggle("flip");
      }
      $(".log-in-btn").click(function(){
        $(".flipper").removeClass("flip");
      });

      $(".hero-right-btn").click(function(){
        $(".flipper").addClass("flip");
      });

      $(".Join-btn").click(function(){
        $(".flipper").addClass("flip");
      });

      registerButton.onclick = function () {
        document.querySelector("#flipper").classList.toggle("flip");
      }
    },
    In_SVG: function() {
      function img2svg() {
        jQuery('.in-svg').each(function(i, e) {
          var $img = jQuery(e);
          var imgID = $img.attr('id');
          var imgClass = $img.attr('class');
          var imgURL = $img.attr('src');
          jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', ' ' + imgClass + ' replaced-svg');
            }
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            // Replace image with new SVG
            $img.replaceWith($svg);
          }, 'xml');
        });
      }
      img2svg();
    },

  };

  office_base_js.__init();
})(jQuery);
