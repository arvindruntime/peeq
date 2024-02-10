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
      office_base_js.light_dark();
      office_base_js.Sticky_header();
      office_base_js.more_less();
      office_base_js.more_less_text();
      office_base_js.Toggle_menu();
      office_base_js.toggle_dropdown();
      office_base_js.In_SVG();
      office_base_js.Sub_menu();
      office_base_js.submenu_drop();
      // office_base_js.play_vedio();
      office_base_js.select_2();
      office_base_js.select();
      // office_base_js.chat_menu();
      office_base_js.post_like();
      office_base_js.comment_reply();
      office_base_js.gallary();
      office_base_js.tooltip();
      // office_base_js.quiz_hide();
      // office_base_js.emoji_on();

    },

    light_dark: function() {
      $(function() {
        $('#checkbox').click(function() {
          $('body').toggleClass('dark');
        });
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

    play_vedio: function() {
      let video = document.getElementById('video');
      document.getElementById('btn').addEventListener('click', button_action);

      function button_action() {
        if (video.paused) {
          video.play();
          $('#btn').click(function() {
            $('#btn').addClass('play');
          });
          // btn.innerHTML = "Puase Video";
        } else {
          video.pause();
          $('#btn').click(function() {
            $('#btn').removeClass('play');
          });
          // btn.innerHTML = "Play Video"
        }
      };
    },

    // More-less button
    more_less: function() {
      $('.moreless-button').click(function() {
        $('.moretext').slideToggle();
        $('.moreless-button').toggleClass('more');
        // if ($('.moreless-button-1').text() == "Read more") {
        //   $(this).text("Read less")
        // } else {
        //   $(this).text("continue")
        // }
      });

    },

    // More-less text
    more_less_text: function() {
      $(document).ready(function() {
        // Configure/customize these variables.
        var showChar = 196; // How many characters are shown by default
        var ellipsestext = "";
        var moretext = "continue";
        var lesstext = " ";


        $('.more').each(function() {
          var content = $(this).html();

          if (content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext + ' </span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
          }

        });

        $(".morelink").click(function() {
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
    Toggle_menu: function() {
      jQuery(document).ready(function() {
        jQuery(".lm_open").click(function() {
          jQuery(".lm_open").toggleClass("open");
          jQuery(".lm_nav").toggleClass("active");
          // jQuery("body").toggleClass("menu-open");
        });
      });
    },

    toggle_dropdown: function() {
      $(".dropdown-toggle-sound").click(function() {
        $(".dropdown-sound").toggleClass("main");
      });
    },

    gallary: function() {
      // Gallary
      $(".lm-img-box").click(function() {
        $(this).toggleClass('active').siblings().removeClass('active');
        // $('.lm__insdtl').addClass('show');
        if ($('.lm__insdtl').hasClass('show')) {
          $('.lm__insdtl').removeClass('show')
        } else {
          $('.lm__insdtl').addClass('show')
        }
      });

    },

    tooltip: function() {
      // Tooltips
      $('.tip').each(function() {
        $(this).tooltip({
          html: true,
          title: $('#' + $(this).data('tip')).html()
        });
      });
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

    submenu_drop: function() {
      $(document).ready(function() {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
          event.preventDefault();
          event.stopPropagation();
          $(this).parent().siblings().removeClass('open');
          $(this).parent().toggleClass('open');
        });
      });

    },

    post_like: function() {
      $(".post-like").click(function() {
        $(this).toggleClass("active");

      });

      $(".post-book").click(function() {
        $(this).toggleClass("active");
      });

    },
    comment_reply: function() {
      $(".post_cmtt").focus(function() {
        // $(".show").show(); //show when user moves focus in the textarea
        $('.post_cmtt-show').addClass('active');
      });

      $(".btn-cancle").click(function() {
        $(".post_cmtt-show").removeClass('active');
      });
      $(".lm_rep").click(function() {
        // $(".show").show(); //show when user moves focus in the textarea
        $(this).addClass('active');
      });

    },

    // SVG file to SVG code convert JS Start
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


    select_2: function() {
      $('.js-example-basic-single').select2();
    },

    select: function() {
      $('#select_box').change(function() {
        var select = $(this).find(':selected').val();
        $(".hide").hide();
        $('#' + select).show();

      }).change();

    },


  };

  office_base_js.__init();
})(jQuery);


follow();

function follow() {
  $(".btn-follow").click(function() {
    if ($(this).text() == "Following") {
      $(this).text("Follow");
      $(this).addClass('active');
    } else {
      $(this).text("Following");
      $(this).removeClass('active');
    }
  });
}


// 
$('.js-example-basic-single').select2();

$('.js-example-basic-single').select2({
  dropdownParent: $('.offcanvas')
});

// Chat-menu
$(".chat_list").click(function() {
  $(".lm__chat-list").toggleClass("active");
});

$(".chat-group").click(function() {
  $(".lm__chat-list").toggleClass("active");
});

// Menu
function resize() {
  if ($(window).width() <= 768) {
    $('.lm__chat-list').addClass('active');
  } else {
    $('.lm__chat-list').removeClass('active');
  }
};

$(document).ready(function() {
  $(window).resize(resize);
  resize();

});

$(document).ready(function() {
  $("#select_box2").select2({});
});

$(document).ready(function() {
  $("#select_box1").select2({});
});

$(document).ready(function() {
  $("#select_box3").select2({});
});
$(document).ready(function() {
  $("#select_box4").select2({});
});

$(document).ready(function() {
  $("#select_box5").select2({});
});

document.addEventListener('DOMContentLoaded', function() {

  /* initialize the external events
  -----------------------------------------------------------------*/

  var containerEl = document.getElementById('external-events-list');
  new FullCalendar.Draggable(containerEl, {
    itemSelector: '.fc-event',
    eventData: function(eventEl) {
      return {
        title: eventEl.innerText.trim()
      }
    }
  });


  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar
    drop: function(arg) {
      // is the "remove after drop" checkbox checked?
      if (document.getElementById('drop-remove').checked) {
        // if so, remove the element from the "Draggable Events" list
        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
      }
    }
  });
  calendar.render();

});


// CKEDITOR.addCss('.ckplot { background-color: black; color: white }');
// CKEDITOR.replace("ckplot");
// CKEDITOR.instances["ckplot"].setData("<p> Describe your new event </p>")

// CKEDITOR.replace('editor1');
// CKEDITOR.add

// CKEDITOR.replace('editor2');
// CKEDITOR.add

// CKEDITOR.replace('editor3');
// CKEDITOR.add


document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,title,next,today',
      // center: 'prev,title,next,today',
      right: 'listMonth,timeGridDay,timeGridWeek,dayGridMonth',
      // listMonth,timeGridDay,timeGridWeek,dayGridMonth
      // right: 'listMonth,dayGridMonth,timeGridWeek,timeGridDay,listMonth'

    },
    initialDate: '2023-03-28',
    defaultDate: '2023-03-28',
    //   navLinks: true, // can click day/week names to navigate views
    businessHours: true, // display business hours
    editable: true,
    selectable: true,
    dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
      'Thursday', 'Friday', 'Saturday'
    ],
    events: [{
        title: 'Business Lunch',
        start: '2023-04-03T13:00:00',
        constraint: 'businessHours'
      },
      {
        title: 'Meeting',
        start: '2023-04-13T11:00:00',
        constraint: 'availableForMeeting', // defined below
        color: '#257e4a'
      },
      {
        title: 'Conference',
        start: '2023-04-22',
      },
      {
        title: 'Party',
        start: '2023-04-29T20:00:00'
      },

      // areas where "Meeting" must be dropped
      {
        groupId: 'availableForMeeting',
        start: '2023-03-15',
        display: 'background'
      },
      {
        groupId: 'availableForMeeting',
        start: '2023-03-22',
        display: 'background'
      },

      // red areas where no events can be dropped
      {
        start: '2023-04-24',
        end: '2023-04-28',
        overlap: false,
        display: 'background',
        color: '#ff9f89'
      },
      {
        start: '2023-04-06',
        end: '2023-04-08',
        overlap: false,
        display: 'background',
        color: '#ff9f89'
      }
    ]
  });

  calendar.render();
});


function formatState(state) {
  if (!state.id) {
    return state.text;
  }
  var $state = $(
    '<div class="d-flex gap-2 align-items-center"> <span class="avtar-30"><img src="' + $(state.element).attr('data-src') + '" class="img-flag" /></span> ' + state.text + '</span></div>'
  );
  return $state;
};

$('.select-img').select2({
  minimumResultsForSearch: Infinity,
  templateResult: formatState,
  templateSelection: formatState
});


// Quiz hide show
$('.lm__edit--arrow').click(function() {
  $('.lm__quizinput, .lm__quiz--animation').slideToggle();
  $('.lm__quizbox').toggleClass('active');
});
$('.lm__editeye').click(function() {
  $(this).toggleClass('active');
});


// var editor = new EditorJS({

//   holderId: "editorjs-one",

//   tools: {
//        header: {
//       class: Header,
//       inlineToolbar: ["link"],
//       config: {
//         placeholder: "Header"
//       },
//       shortcut: "CMD+SHIFT+H"
//     }
//   },

//   data: {
//     blocks: [
//       {
//         type: "header",
//         data: {
//           text: "Editor.js",
//           level: 2
//         }
//       },
//       {
//         type: "paragraph",
//         data: {
//           text:
//             "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration."
//         }
//       },
//     ]
//   },
//   // onReady: function () {
//   //   saveButton.click();
//   // },
//   // onChange: function () {
//   //   console.log("something changed");
//   // }
// });

// Visible hidden
$('.visible-hidden').on('click', function(e) {
  var value = $('.visible-hidden').is(':checked');

  if (value) {
    $('#visible-hidden').text("Hidden");
  } else {
    $('#visible-hidden').text("Visible");
  }
});

// On off
$('.on-off').on('click', function(e) {
  var value = $('.on-off').is(':checked');

  if (value) {
    $('#on-off').text("On");
  } else {
    $('#on-off').text("Off");
  }
});

// radio
$("input[name=action]").change(function() {
  var test = $(this).val();
  $(".show-hide").addClass('show');
  $("#" + test).removeClass('show');
});

$('input:radio').click(function() {
  $('input:radio[name=' + $(this).attr('name') + ']').parent().removeClass('checked11');
  $(this).parent().addClass('checked11');

});


$('.btn-toogle').on('click', function() {
  $('.lm__dash').toggleClass('show-aside');
});
$('.aside-colse').on('click', function() {
  $('.lm__dash').toggleClass('show-aside');
});


$('select:not(.normal)').each(function() {
  $(this).select2({
    dropdownParent: $(this).parent(),
    dropdownParent: $('.offcanvas')
  });
});


// $('.offcanvas .select2').each(function() {  
//   var $p = $(this).parent(); 
//   $(this).select2({  
//     dropdownParent: $p  
//   });  
// });

// $(document).ready(function() {
//   $("#select_box3").select2({
//     dropdownParent: $("#offcanvasRight1")
//   });
// });

$(document).ready(function() {
  $("#select_box1").select2({
    dropdownParent: $("#offcanvasRight15")
  });
});

$(document).ready(function() {
  $(".select2").select2({
    dropdownParent: $("#setTimeZoneModal")
  });
});