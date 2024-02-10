"use strict";

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

(function ($) {
  var office_base_js = {
    __init: function __init() {
      // var self_obj = this;
      // office_base_js.AIO_reload();
      $(document).ready(this.initialize_ele); // $(window).load(this.onload_function);
      // $(document).on('click', '.btn', this.btn_click_event);
    },
    initialize_ele: function initialize_ele() {
      // console.log("Ready");
      // office_base_js.light_dark();
      office_base_js.Sticky_header();
      office_base_js.more_less();
      office_base_js.more_less_text();
      office_base_js.Toggle_menu();
      office_base_js.toggle_dropdown();
      office_base_js.In_SVG();
      office_base_js.Sub_menu();
      office_base_js.submenu_drop(); // office_base_js.play_vedio();

      office_base_js.select_2();
      office_base_js.select(); // office_base_js.chat_menu();

      office_base_js.post_like();
      office_base_js.comment_reply();
      office_base_js.gallary();
      office_base_js.tooltip();
      office_base_js.visible();
      office_base_js.quiz();
      office_base_js.eye(); // office_base_js.quiz_hide();
      // office_base_js.emoji_on();
    },
    visible: function visible() {
      $('.visible-hidden').on('click', function (e) {
        var value = $('.visible-hidden').is(':checked');

        if (value) {
          $('#visible-hidden').text("Hidden");
        } else {
          $('#visible-hidden').text("Visible");
        }
      });
    },
    eye: function eye() {
      $('.lm__edit--arrow').click(function () {
        $('.lm__quizinput, .lm__quiz--animation').slideToggle();
        $('.lm__quizbox').toggleClass('active');
      });
    },
    quiz: function quiz() {
      $('.lm__editeye').click(function () {
        $(this).toggleClass('active');
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
    },
    play_vedio: function play_vedio() {
      var video = document.getElementById('video');
      document.getElementById('btn').addEventListener('click', button_action);

      function button_action() {
        if (video.paused) {
          video.play();
          $('#btn').click(function () {
            $('#btn').addClass('play');
          }); // btn.innerHTML = "Puase Video";
        } else {
          video.pause();
          $('#btn').click(function () {
            $('#btn').removeClass('play');
          }); // btn.innerHTML = "Play Video"
        }
      }

      ;
    },
    // More-less button
    more_less: function more_less() {
      $('.moreless-button').click(function () {
        $('.moretext').slideToggle();
        $('.moreless-button').toggleClass('more'); // if ($('.moreless-button-1').text() == "Read more") {
        //   $(this).text("Read less")
        // } else {
        //   $(this).text("continue")
        // }
      });
    },
    // More-less text
    more_less_text: function more_less_text() {
      $(document).ready(function () {
        // Configure/customize these variables.
        var showChar = 196; // How many characters are shown by default

        var ellipsestext = "";
        var moretext = "continue";
        var lesstext = " ";
        $('.more').each(function () {
          var content = $(this).html();

          if (content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
            var html = c + '<span class="moreellipses">' + ellipsestext + ' </span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';
            $(this).html(html);
          }
        });
        $(".morelink").click(function () {
          if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
          } else {
            $(this).addClass("less");
            $(this).html(lesstext);
          }

          $(this).parent().prev().toggle();
          $(this).prev().toggle();
          return false;
        });
      });
    },
    // Toggle menu
    Toggle_menu: function Toggle_menu() {
      jQuery(document).ready(function () {
        jQuery(".lm_open").click(function () {
          jQuery(".lm_open").toggleClass("open");
          jQuery(".lm_nav").toggleClass("active"); // jQuery("body").toggleClass("menu-open");
        });
      });
    },
    toggle_dropdown: function toggle_dropdown() {
      $(".dropdown-toggle-sound").click(function () {
        $(".dropdown-sound").toggleClass("main");
      });
    },
    gallary: function gallary() {
      // Gallary
      $(".lm-img-box").click(function () {
        $(this).toggleClass('active').siblings().removeClass('active'); // $('.lm__insdtl').addClass('show');

        if ($('.lm__insdtl').hasClass('show')) {
          $('.lm__insdtl').removeClass('show');
        } else {
          $('.lm__insdtl').addClass('show');
        }
      });
    },
    tooltip: function tooltip() {
      // Tooltips
      $('.tip').each(function () {
        $(this).tooltip({
          html: true,
          title: $('#' + $(this).data('tip')).html()
        });
      });
    },
    // Mobile View Submenu JS
    Sub_menu: function Sub_menu() {
      jQuery(document).ready(function () {
        $('.menu-item-has-children a').click(function () {
          // if ($(window).width() < 1200) {
          $(this).siblings().toggleClass("show"); // }
        });
      });
      $('.btn-toogle').on('click', function () {
        $('.lm__dash').toggleClass('show-aside');
        $('body').toggleClass('show');
      });
      $('.aside-colse').on('click', function () {
        $('.lm__dash').toggleClass('show-aside');
        $('body').toggleClass('show');
      });
    },
    submenu_drop: function submenu_drop() {
      $(document).ready(function () {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
          event.preventDefault();
          event.stopPropagation();
          $(this).parent().siblings().removeClass('open');
          $(this).parent().toggleClass('open');
        });
      });
    },
    post_like: function post_like() {
      $(".post-like").click(function () {
        $(this).toggleClass("active");
      });
      $(".post-book").click(function () {
        $(this).toggleClass("active");
      });
    },
    comment_reply: function comment_reply() {
      $(".post_cmtt").focus(function () {
        // $(".show").show(); //show when user moves focus in the textarea
        $('.post_cmtt-show').addClass('active');
      });
      $(".btn-cancle").click(function () {
        $(".post_cmtt-show").removeClass('active');
      });
      $(".lm_rep").click(function () {
        // $(".show").show(); //show when user moves focus in the textarea
        $(this).addClass('active');
      });
    },
    // SVG file to SVG code convert JS Start
    In_SVG: function In_SVG() {
      function img2svg() {
        jQuery('.in-svg').each(function (i, e) {
          var $img = jQuery(e);
          var imgID = $img.attr('id');
          var imgClass = $img.attr('class');
          var imgURL = $img.attr('src');
          jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg'); // Add replaced image's ID to the new SVG

            if (typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            } // Add replaced image's classes to the new SVG


            if (typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', ' ' + imgClass + ' replaced-svg');
            } // Remove any invalid XML tags as per http://validator.w3.org


            $svg = $svg.removeAttr('xmlns:a'); // Replace image with new SVG

            $img.replaceWith($svg);
          }, 'xml');
        });
      }

      img2svg();
    },
    select_2: function select_2() {
      $('.js-example-basic-single').select2();
    },
    select: function select() {
      $('#select_box').change(function () {
        var select = $(this).find(':selected').val();
        $(".hide").hide();
        $('#' + select).show();
      }).change();
    }
  };

  office_base_js.__init();
})(jQuery);

$("input[name=action]").change(function () {
  var test = $(this).val();
  $(".show-hide").addClass('show');
  $("#" + test).removeClass('show');
});
$('input:radio').click(function () {
  $('input:radio[name=' + $(this).attr('name') + ']').parent().removeClass('checked11');
  $(this).parent().addClass('checked11');
});
$('.btn-toogle').on('click', function () {
  $('.lm__dash').toggleClass('show-aside');
});
$('.aside-colse').on('click', function () {
  $('.lm__dash').toggleClass('show-aside');
});
$('select:not(.normal)').each(function () {
  $(this).select2(_defineProperty({
    dropdownParent: $(this).parent()
  }, "dropdownParent", $('.offcanvas')));
});

function sessionSelectFunction() {
  $('.select2-wrap').select2({
    minimumResultsForSearch: Infinity
  });
}

$(document).ready(function () {
  sessionSelectFunction();
}); // $(document).ready(function() {
//   $("#select_box1").select2({});
// });
// $(document).ready(function() {
//   $("#select_box3").select2({});
// });
// $(document).ready(function() {
//   $("#select_box4").select2({});
// });
// $(document).ready(function() {
//   $("#select_box5").select2({});
// });
// $(document).ready(function() {
//   $("#select_box3").select2({
//     dropdownParent: $("#offcanvasRight1")
//   });
// });
// $(document).ready(function() {
//   $("#select_box1").select2({
//     dropdownParent: $("#offcanvasRight15")
//   });
// });
// $(document).ready(function() {
//   $(".select2").select2({
//     dropdownParent: $("#offcanvasRight9")
//   });
// });
// CKEDITOR.replace('editor1');
// CKEDITOR.add
// CKEDITOR.replace('editor2');
// CKEDITOR.add
// CKEDITOR.replace('editor3');
// CKEDITOR.add
// CKEDITOR.replace('editor4');
// CKEDITOR.add

$('.visible-hidden').on('click', function (e) {
  var value = $('.visible-hidden').is(':checked');

  if (value) {
    $('#visible-hidden').text("Hidden");
  } else {
    $('#visible-hidden').text("Visible");
  }
}); // On off

$('.on-off').on('click', function (e) {
  var value = $('.on-off').is(':checked');

  if (value) {
    $('#on-off').text("On");
  } else {
    $('#on-off').text("Off");
  }
});
$('.lm__edit--arrow').click(function () {
  $('.lm__quizinput, .lm__quiz--animation').slideToggle();
  $('.lm__quizbox').toggleClass('active');
});
$('.lm__editeye').click(function () {
  $(this).toggleClass('active');
});
$(window).click(function () {
  $('.dropdown-submenu').removeClass('open');
}); // function formatState(state) {
//   if (!state.id) {
//     return state.text;
//   }
//   var $state = $(
//     '<div class="d-flex gap-2 align-items-center"> <span class="avtar-30"><img src="' + $(state.element).attr('data-src') + '" class="img-flag" /></span> ' + state.text + '</span></div>'
//   );
//   return $state;
// };
// $('.select-img').select2({
//   minimumResultsForSearch: Infinity,
//   templateResult: formatState,
//   templateSelection: formatState
// });
// Edit Plan
// $(document).ready(function() {
//   $("#plan_type_edit").select2({
//     dropdownParent: $("#offcanvasRight4")
//   });
// });
// $(document).ready(function() {
//   $("#status_edit").select2({
//     dropdownParent: $("#offcanvasRight4")
//   });
// });
//   $(document).ready(function() {
//     $("#location_edit, #timezone_edit").select2({
//         dropdownParent: $("#offcanvasRight1")
//     });
// });

$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#scroll').fadeIn();
    } else {
      $('#scroll').fadeOut();
    }
  });
  $('#scroll').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
}); // $('.dropdown-custom').on('click', function() {
//   $('.dropdown-menu').toggleClass('show-menu');
//   // $('body').toggleClass('show');
// });

$('.lm__listchecked').click(function () {
  $(this).toggleClass('active');
}); // $(function() {
//   $(".dropdown-custom").on("click", function(e) {
//     e.stopPropagation(); // Prevent the click event from reaching the document
//     $(".dropdown-menu").toggleClass("show-menu");
//   });
//    $(document).on("click", function(e) {
//      if (!$(e.target).is(".dropdown-menu, .dropdown-custom")) {
//       $(".dropdown-menu").removeClass("show-menu");
//      }
//    });
// });

$(function () {
  $(".dropdown-custom").on("click", function (e) {
    e.stopPropagation(); // Prevent the click event from reaching the document

    $(".dropdown-menu").toggleClass("show-menu");
  });
  $(document).on("click", function (e) {
    var dropdown = $(".dropdown-menu");

    if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) {
      // Close the dropdown only if the clicked element is not inside it
      dropdown.removeClass("show-menu");
      var lable = $('.volume__button').attr('aria-label');

      if (lable) {
        $('.volume__button').removeClass('open');
        $('.volume__controls').addClass('hidden');
      }
    }
  });
});