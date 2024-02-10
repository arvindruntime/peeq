@include('layouts.seo_meta_script')   
  <meta name="viewport" content="width=1180">                       
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon1.ico')}}" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://carstenschaefer.github.io/DrawerJs/dist/drawerJs.css" />
  <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/froala_style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/green-audio-player.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  
  <style>
    .dropdown.lm__interactive-audio .dropdown-custom{
    cursor:pointer;
}
    .ready-player-1,
    .ready-player-2,
    .ready-player-3,
    .ready-player-4 {
        margin: 24px 0;
    }

    .green-audio-player {
        justify-content: flex-start;
        height: 72px;
        padding-top: 20px;
        width: 100%;
        position: relative;
        padding: 35px 10px 15px;
    }

    .green-audio-player .controls {
        flex-grow: initial;
        display: inline-block;
    }

    .green-audio-player .controls .controls__slider {
        border-radius: 10px;
        height: 10px;
        overflow: hidden;
        width: calc(100% - 20px);
        position: absolute;
        top: 15px;
        left: 0;
        margin-left: 10px;
        margin-right: 10px;
    }

    .green-audio-player .volume {
        display: inline-block;
    }
    .green-audio-player .slider .gap-progress .pin{
        opacity: 0;
    }
    .green-audio-player .slider .gap-progress {
        background-color: #E3A130;
    }
    .green-audio-player .controls span.controls__current-time:after {
        content: '/';
        position: relative;
        margin-left: 5px;
    }
    .green-audio-player .volume .volume__button.open path {
        fill: #e3a130;
    }
    .green-audio-player svg, .green-audio-player img {
        width: 16px;
        height: 16px;
    }
  .flex.justify-content-end .btn.btn--green {
    min-width:auto;
    padding: 5px 18px;
    font-size: 16px;
    margin-right: 40px;
    background: #008000;
    border: #008000;
  }
  .btn--green:hover{
    background: #005800 !important;
  }
  .pt-0{
    padding-top: 0 !important;
  }
  .flex.justify-content-end.mb-2 {
    margin-right: 40px;
}
.lm__interactive-audio .dropdown-menu.show-menu{
  margin-right: 40px;
}
.lm__interactive-audio .dropdown-menu{
  margin-right: 40px;
}
</style>

  <style>
     .lm_pdf .lm_coches{
      display: block;
    } 
    .gap-4 {
      gap: 15px;
    }
    .lm_pdf-card h1, .lm_pdf-card h2, .lm_pdf-card p, .lm_pdf-card span, .lm_pdf-card tr, .lm_pdf-card td, .lm_pdf-card th {
      font-family: "PlayfairDisplay", sans-serif !important;
    }
    .lm_pdf-card .lm__consumption-edit textarea, .lm_pdf-card .lm__task-editor textarea {
      font-family: "PlayfairDisplay", sans-serif !important;
    }
    .h-100{
      height: 100%;
    }
    .flex-column{
      flex-direction: column;
    }
    .position-absolute{
      position: absolute;
    }
    h3{
      font-size: 30px;
    }
    .lm__dash-con.lm__event-con.lm_pdf .lm_pdf-card.card .lm_pdf-right .lm_right {
        padding: 20px 50px 0px 50px;
    }
    .left-main.fr-view{
        height:100%;
    }
    .wb_footer{
        position:absolute;
        width:100%;
        bottom:0 ;
        left: 0;
        right: 0;
    }
    .lm__consumption .lm__consumption-edit textarea {
      border-radius: 15px !important;
    }

    p.mb-0.text-black.lh-1 {
      padding: 15px;
    }


    p.mb-0.text-black.lh-1 {
    padding: 12px;
    }

    :root {
      --base-text: 1rem !important;
    }
    .left-main.fr-view p{
      padding: 0 22px;
    }
    #loader-container- {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* background-color: rgba(0, 0, 0, 0.5);  */
      background: #ffff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      z-index: 9999999;
    }
  
    #loader-container {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* background-color: rgb(255, 255, 255);  */
      background: #fff !important;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }
    .auto-load {
      display: none;
    }
  
    .errorClass {
      border: 1px solid red !important;
    }
  
    /* Loader */
    .loader {
      /* margin: 20% auto 0; */
      transform: translateZ(0);
    }
    .loader:before,
    .loader:after {
      content: '';
      position: absolute;
      top: 0;
    }
    .loader:before,
    .loader:after,
    .loader {
      border-radius: 50%;
      width: 20px;
      height: 20px;
      animation: animation 1.2s infinite ease-in-out;
    }
    .loader {
      animation-delay: -0.16s;
    }
    .loader:before {
      left: -3.5em;
      animation-delay: -0.32s;
    }
    .loader:after {
      left: 3.5em;
    }
    @keyframes animation {
  
      0%,
      80%,
      100% {
        box-shadow: 0 2em 0 -1em #E3A130;
      }
  
      40% {
        box-shadow: 0 2em 0 0 #E3A130;
      }
    }
    .lm_pdf .lm_coches{
      display: block;
    }
    .highlight.anchor-text button {
    display: none;
}
  </style>
</head>
{{-- {{ dd($interactiveworkbook); }} --}}
<body>
  <div id="loader-container-" class="loader-container">
    {{-- <div class="loadaer-logo">
      <img src="{{ asset('assets/images/dash-logo.svg') }}">
    </div> --}}
    <div class="loader"></div>
  </div>
  <input type="hidden" name="interactive_workbook_module_id" id="interactive_workbook_module_id" value="{{ $course_module_id }}">
  <input type="hidden" name="auth_user_id" id="auth_user_id" value="{{ $user->id }}">
  <main class="main-content" id="main">
    <section class="lm__dash-con lm__event-con lm_pdf mt-0">
      <span class="lm_vec">
        <img class="light" src="{{asset('assets/images/light.png')}}" alt="">
        <img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
      <div class="container mb-5">
        <!-- <div id="canvas-editor"></div> -->
        <div class="row">
          <div class="col-12 mx-auto">
            <div class="pdf-title">
              <h3 class="fw-bold text-primary">
                {{-- {{ dd($interactiveworkbook)}} --}}
              </h3>
            </div>
            <!-- Main pdf con -->
            <div class="lm_pdf-card card">
              <span class="lm_spiral">
                <img src="{{asset('assets/images/spiral.png')}}" alt="">
              </span>
              {{-- Audio --}}
              @if (isset($audio_recording))
              <div class="flex justify-content-end mb-2">
                <div class="dropdown lm__interactive-audio">
                  <div class="flex align-items-center rounded-pill bg-white border-white shadow px-2 py-1 dropdown-custom" data-bs-toggle="dropdown">
                    <img src="{{asset('assets/images/audio2.svg')}}" alt="" class="mr-2">
                    <p class="text-black mb-0 mr-1">Audio</p>
                  </div>
                  <div class="dropdown-menu p-3 lm_drop border-0 shadow mt-3 rounded-3">
                    {{-- <h5 class="mb-2">Heading</h5> --}}
                    
                    
                    <div class="ready-player-1 player">
                      <audio id="audioPlayer">
                          <source src="{{ $audio_recording }}" type="audio/mpeg">
                      </audio>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              <div class="d-flex card-flex lm__book mx-auto">
                <div class="lm_pdf-main page">
                  <div class="pl-3 pt-3 position-absolute"> 
                    <img src="{{ asset('assets/images/new-luminary-logo.png') }}" style="width: 40%" alt="">
                  </div>
                  <div class="flex flex-column justify-content-center align-items-center h-100 pl-3 pr-3">
                    <h3 class="text-primary mb-0">{{ $course_module_title }}</h3>
                  </div>
                </div>
                @php
                  $flag=0;
                  $startpageno = 0;            
                @endphp
                @foreach ($interactiveworkbook as $k=>$interactive)
                @php
                  if($flag==0)
                  {
                    $startpageno=$interactive->page_no;
                    $flag=1;
                  }
                  $lastpageno=$interactive->page_no;
                  @endphp
                <div class="lm_pdf-left page">
                  <div class="left-main fr-view">
                    @if($interactive->page_no!=$startpageno)
                    
                      {{-- Start header --}}
                      <table style="width: 100%;margin-top: 0px;">
                        <tbody>
                          <tr>
                            <td style="width: 6.6051%; border: 0;">
                              <p style="background: #e3a22a; height: 50px;"><br></p>
                            </td>
                            <td style="width: 28.7142%;border: 0;vertical-align: top;">
                              <img src="{{ asset('assets/images/new-luminary-logo.png') }}" style="width: 130px;padding: 6px;" class="fr-fic fr-dib">
                            </td>
                            <td style="width: 84.4473%; border: 0;"><p style="background: #06172b; height: 50px;line-height: 50px;color:#ffffff; padding: 0px; font-size: 14px;">&nbsp; &nbsp; {{ $course_module_title }}</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      {{-- End header --}}
                    @endif
                    <div class="pdf-left_list">
                      {!! $interactive->pdf_content !!}
                    </div>
                    @if(isset($interactive->audio_file) && $interactive->audio_file!='')
                    <input type="hidden" class="audioFileUrl audioFileUrl{{ $k }}" audio-url="{{ $interactive->audio_file }}" value="{{ $interactive->audio_file }}">
                    @endif

                  </div>

                  {{-- Start footer --}}
                  <div class="wb_footer" style="text-align: center;font-size: 16px;background: #06172b;color: #ffff;padding: 5px 0px 0px;">
                    <span style="font-size: 14px;">© {{ date('Y') }} PEEQ™ (Luminary Mindset™)</sup></span>
                    <h4 style="background: #e3a22a;margin-top: 21px;font-size: 16px;margin: 0px;margin-top: 5px;">{{$interactive->page_no }}</h4>
                  </div>
                  {{-- End footer --}}

                </div>
                               
                  <div class="lm_pdf-right page">
                    @php
                      $interactive_id = $interactive->id;
                    @endphp
                                            
                      <div class="lm_right">
                        <div class="lm_right-title flex align-items-center">
                          <div class="col-md-6">
                            <h3 class="mb-0 text-right">Notes</h3>
                          </div>
                          <div class="col-md-6">
                            <div class="flex justify-content-end"><button class="btn btn--green pl-3 pr-3 pt-2 pb-2" onClick="performAction({{$interactive_id}})">Save <img src="{{ asset('assets/images/prime_save.svg') }}" alt=""></button></div>
                          </div>
                          
                        </div>
                        <img src="{{asset('assets/images/note-border.png')}}" alt="" class="mx-auto">
                      </div>
                      
                      <form name="AddInteractiveUserDetailsForm" class="AddInteractiveUserDetailsForm">
                        <input type="hidden" name="interactive_workbook_id" class="interactive_workbook_id" value="{{$interactive->id}}">
                        
                      <div class="pdf_con" id="pdf_con_{{$interactive->id}}">
                       
                        <div>
                          @php 
                          $userContent = getDetailsUserwise($interactive->id, $user->id); 
                          @endphp
                          @if($userContent)
                          {!! $userContent !!}
                          @else
                          {!! $interactive->interactive_content !!}
                          @endif
                        </div>
                      </div>
                      
                      
                    </form>
                  </div>
              @endforeach
                
              </div>
              <!-- Coches -->
            </div>
            <div class="row justify-content-end">
              <div class="flex align-items-center justify-content-between gap-2 mt-2 pt-2" style="width: 54%;">
                <div class="flex align-items-center">
                  <a href="javascript:void(0)" class="flip-button" onclick="prevPage()">
                    <img src="{{asset('assets/images/prev.svg')}}" alt="" class="in-svg">
                  </a>
                  <span id="currentPage">{{$startpageno - 1 }}</span>/<span id="totalPages">{{ $lastpageno }}</span>
                  <span id="start_page_no" style="display: none">{{$startpageno}}</span>
                  
                  <a href="javascript:void(0)" class="flip-button" onclick="nextPage()">
                    <img src="{{asset('assets/images/back.svg')}}" alt="" class="in-svg">
                  </a>
                </div>
              </div>
            </div>

            <div class="lm_coches d-flex align-items-center gap-2 pt-0">
              <h5 class="fw-bold mb-2">Coaches</h5>
              <div class="flex align-items-center gap-3 flex-wrap">
                @foreach ($coaches as $key => $coache)
                <div class="lm_coches-con mr-2">
                  <div class="flex justify-content-between align-items-center gap-2">
                    <span class="avtar-45 shadow">
                      <img src="{{ $coache->profile_image_url ?? asset('assets/images/avtar-6.jpg')}}" alt="" style="width: 100%; height:100%;">
                    </span>
                    <p class="mb-0 me-4 text-dark">{{ $coache->first_name.' '.$coache->last_name }}</p>
                    {{-- <a href="{{ ("chat_memberlist") }}?user_id={{$member->id}}" class="btn btn--primary btn-sm">Chat</a> --}}
                  </div>
                </div>
                @endforeach
                  
              </div>
            </div>
          </div>
          <!-- <div id="sketchpad" style="background-image: url('assets/images/audit.jpg'); background-repeat: no-repeat;"></div> -->

    </section>
    <div class="lm__modal-overlay">
      <div class="lm__modal">
        <p class="mb-2 h4 text-black">Are you sure you want to remove this note?</p>
        <div class="lm__modal-buttons">
          <a href="#" class="lm__modal-cancel p-1 mr-1 text-danger">Cancel</a>
          <a href="#" class="lm__modal-confirm p-1 text-primary">Confirm</a>
        </div>
      </div>
    </div>
  </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://carstenschaefer.github.io/DrawerJs/dist/drawerJs.standalone.js"></script>
<script src="{{ asset('assets/js/turn-4.js') }}"> </script>
<script src="{{ asset('assets/js/main.js') }}"> </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

{{-- <script>
  let book = null;

  var user_id = $("#auth_user_id").val();
  var module_id = $("#interactive_workbook_module_id").val();
  var currentPageElementID = "#currentPage";
  $.ajax({
    url: "{{ route('user.interactive.detail.get') }}",
    type: "GET",
    data: { user_id: user_id, module_id: module_id },
    success: function(response) {
      var old_page_no = parseInt(response);
      if(old_page_no == 1) {
        old_page_no = parseInt($('#start_page_no').text());
      }
      $(currentPageElementID).text(old_page_no);
      final_page_no=old_page_no;
            
      let startPageNo = parseInt(document.getElementById('start_page_no').textContent);
            
      final_page_no = (final_page_no -startPageNo);
      if(startPageNo!=0) {
      final_page_no = (final_page_no) +1;
      }
    
      final_page_no=final_page_no*2;
      if(final_page_no==0)
      {
        final_page_no=1;
      }
      
      book = $(".lm__book").turn({
        page:final_page_no,
        duration: 900,
        height: 800,
        width: 1180,
        when: {
          turning: function(event, page, view) {
            book.bind("start", function(event, pageObject, corner) {
              if (corner == 'br' || corner == 'tr') {
                let totalPages = parseInt(document.getElementById('totalPages').textContent);
                let currentPage = parseInt($(currentPageElementID).text());
                if (currentPage < totalPages) {
                  var newPage = currentPage + 1;
                  book.bind("turned", function() {
                    updateCurrentPage(newPage);
                    var audioElement = document.getElementById("audioPlayer");
                    if(audioElement){
                      audioElement.load();
                      $(audioElement).stop();
                    }
                  });
                }
              } else if (corner == 'bl' || corner == 'tl') {
                let startPageNo = parseInt(document.getElementById('start_page_no').textContent);
                let currentPage = parseInt($(currentPageElementID).text());
                if (currentPage >= startPageNo) {
                  var newPage = currentPage - 1;
                  book.bind("turned", function() {
                    updateCurrentPage(newPage);
                    var audioElement = document.getElementById("audioPlayer");
                    if(audioElement){
                      audioElement.load();
                      $(audioElement).stop();
                    }
                  });
                }
              }
            });
          }
        }
      });
    },
    error: function() {
      console.log('Error fetching page details');
    }
  });
  function prevPage() {
    if (book !== null) {
      book.turn('previous');
      let currentPage = parseInt(document.getElementById('currentPage').textContent);
      let startPageNo = parseInt(document.getElementById('start_page_no').textContent);
     // alert(startPageNo[0].tagName);
      if (currentPage >=startPageNo) {
          currentPage--;
          updateCurrentPage(currentPage);
      }
      book.bind('turned',function () {
        updateCurrentPage(currentPage);
      })
    }
  }

  function nextPage() {
    if (book !== null) {
      book.turn('next');
      let currentPage = parseInt(document.getElementById('currentPage').textContent);
      let totalPages = parseInt(document.getElementById('totalPages').textContent);
      if (currentPage < totalPages) {
          currentPage++;
          updateCurrentPage(currentPage);
      }
      book.bind('turned',function () {
        updateCurrentPage(currentPage);
      })
    }
  }

  function updateCurrentPage(pageNumber) {
    console.log('updateCurrentPage function called');
    document.getElementById('currentPage').textContent = pageNumber;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "{{route('user.interactive.detail.store')}}",
        type: "POST",
        data: { user_id: user_id, module_id: module_id, page: pageNumber, _token: csrfToken },
        success: function(response) {
            
        },
        error: function() {
            console.log('Error fetching round details');
        }
    });
  }
</script>  --}}


<script type="text/javascript">
let book = null;
const currentPageElementID = "#currentPage";
const startPageNoElement = document.getElementById('start_page_no');
const totalPagesElement = document.getElementById('totalPages');
const csrfToken = $('meta[name="csrf-token"]').attr('content');
let isAjaxInProgress = false;

function initializeBook(finalPageNo) {
  book = $(".lm__book").turn({
    page: finalPageNo,
    duration: 900,
    height: 800,
    width: 1180,
    when: {
      turning: function(event, page, view) {
        if (!isAjaxInProgress) {
          book.bind("start", function(event, pageObject, corner) {
            if ((corner === 'br' || corner === 'tr') && getCurrentPage() < parseInt(totalPagesElement.textContent)) {
              handlePageTurn(getCurrentPage() + 1);
            } else if ((corner === 'bl' || corner === 'tl') && getCurrentPage() >= parseInt(startPageNoElement.textContent)) {
              handlePageTurn(getCurrentPage() - 1);
            }
          });
        } else {
          // Disable page turning or show a loader while AJAX is in progress
          event.preventDefault();
        }
      }
    }
  });
}

function getCurrentPage() {
  return parseInt($(currentPageElementID).text());
}

function handlePageTurn(newPage) {
  book.bind("turned", function() {
    updateCurrentPage(newPage);
    var audioElement = document.getElementById("audioPlayer");
    if (audioElement) {
      audioElement.load();
      $(audioElement).stop();
    }
  });
}

function initializePageDetails() {
  $.ajax({
    url: "{{ route('user.interactive.detail.get') }}",
    type: "GET",
    data: { user_id: $("#auth_user_id").val(), module_id: $("#interactive_workbook_module_id").val() },
    success: function(response) {
      const old_page_no = parseInt(response) || parseInt($('#start_page_no').text()) || 1;
      $(currentPageElementID).text(old_page_no);
      let final_page_no = (old_page_no - parseInt(startPageNoElement.textContent)) * 2 + 1 || 1;
      initializeBook(final_page_no);
    },
    error: function() {
      console.log('Error fetching page details');
    }
  });
}

function updateCurrentPage(pageNumber) {
  console.log('updateCurrentPage function called');
  $(currentPageElementID).text(pageNumber);
  isAjaxInProgress = true; // Set to true to disable page turning during AJAX
  $.ajax({
    url: "{{ route('user.interactive.detail.store') }}",
    type: "POST",
    data: { user_id: $("#auth_user_id").val(), module_id: $("#interactive_workbook_module_id").val(), page: pageNumber, _token: csrfToken },
    success: function(response) {
      isAjaxInProgress = false; // Set to false after AJAX completes
      // Handle success if needed
    },
    error: function() {
      isAjaxInProgress = false; // Set to false after AJAX completes
      console.log('Error fetching round details');
    }
  });
}

function prevPage() {
  if (book !== null) {
    book.turn('previous');
    const currentPage = getCurrentPage();
    const startPageNo = parseInt(startPageNoElement.textContent);
    if (currentPage >= startPageNo) {
      handlePageTurn(currentPage - 1);
    }
  }
}

function nextPage() {
  if (book !== null) {
    book.turn('next');
    const currentPage = getCurrentPage();
    const totalPages = parseInt(totalPagesElement.textContent);
    if (currentPage < totalPages) {
      handlePageTurn(currentPage + 1);
    }
  }
}

// Initialize the page details and the book
initializePageDetails();


</script>

<script>  
var audio_recording = "{{ $audio_recording }}";
///playAudio(audio_recording);

  function playAudio(audioFile){
    
  if(audioFile!='')
  {
     
    const audioPlayer = document.querySelector(".audio-player");
  const audio = audioPlayer.querySelector("audio");

  if (audio) {
    audio.pause();
    audio.src = audioFile; // Change the audio source to the new URL
  } else {
    // If there's no existing audio element, create a new one
    const newAudio = new Audio(audioFile);
    audioPlayer.appendChild(newAudio);
  }

  audio.volume = 0.75;
  audio.play();

  audio.addEventListener("loadeddata", () => {
    audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
      audio.duration
    );
    audio.volume = 0.75;
  });

    audio.addEventListener(
      "loadeddata",
      () => {
        audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
          audio.duration
        );
        audio.volume = .75;
      },
      false
    );

    //click on timeline to skip around
    const timeline = audioPlayer.querySelector(".timeline");
    timeline.addEventListener("click", e => {
      const timelineWidth = window.getComputedStyle(timeline).width;
      const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
      audio.currentTime = timeToSeek;
    }, false);

    //click volume slider to change volume
    const volumeSlider = audioPlayer.querySelector(".controls .volume-slider");
    volumeSlider.addEventListener('click', e => {
      const sliderWidth = window.getComputedStyle(volumeSlider).width;
      const newVolume = e.offsetX / parseInt(sliderWidth);
      audio.volume = newVolume;
      audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
    }, false)

    //check audio percentage and update time accordingly
    setInterval(() => {
      const progressBar = audioPlayer.querySelector(".progress");
      progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
      audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
        audio.currentTime
      );
    }, 500);
    
    //toggle between playing and pausing on button click
    const playBtn = audioPlayer.querySelector(".controls .toggle-play");
    playBtn.addEventListener(
      "click",
      () => {
        if (audio.paused) {
          playBtn.classList.remove("play");
          playBtn.classList.add("pause");
          audio.play();
        } else {
          playBtn.classList.remove("pause");
          playBtn.classList.add("play");
          audio.pause();
        }
      },
      false
    );

    audioPlayer.querySelector(".volume-button").addEventListener("click", () => {
      const volumeEl = audioPlayer.querySelector(".volume-container .volume");
      audio.muted = !audio.muted;
      if (audio.muted) {
        volumeEl.classList.remove("icono-volumeMedium");
        volumeEl.classList.add("icono-volumeMute");
      } else {
        volumeEl.classList.add("icono-volumeMedium");
        volumeEl.classList.remove("icono-volumeMute");
      }
    });
  }

    
  }
  //turn 128 seconds into 2:08
  function getTimeCodeFromNum(num) {
      let seconds = parseInt(num);
      let minutes = parseInt(seconds / 60);
      seconds -= minutes * 60;
      const hours = parseInt(minutes / 60);
      minutes -= hours * 60;

      if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
      return `${String(hours).padStart(2, 0)}:${minutes}:${String(
              seconds % 60
          ).padStart(2, 0)}`;
    }

$('.lm__listchecked').click(function() {
  $(this).toggleClass('active');
});
</script>
<script>
  function showContent() {
    // Show the auto-load sections
    $('.auto-load').show();
  }

  function showLoader(sectionId='') {
    // Show the loader initially
    $('#loader-container-' + sectionId).show();
  }
  
  function hideLoader(sectionId='') {
    // Hide the loader when content is loaded
    $('#loader-container-' + sectionId).hide();
  }
    
  $(document).ready(function() {
    // Show the initial loader
    showLoader();
  
    // Hide the content of all auto-load sections initially
    $('.auto-load').hide();
  
    // Simulate a delay of 2 seconds to demonstrate loading
    setTimeout(function() {
      // Show the content of each auto-load section and hide the loader
      $('.auto-load').each(function() {
        showContent($(this));
      });
      hideLoader();
    }, 400);
  });
</script>
<script>
$(document).ready(function() {
  let noteId = 0;
  let isAddingNote = false;
  let noteToDelete;

  const leftDiv = $('.lm_pdf-left');
  const rightDiv = $('.lm_pdf-right');
  const pdfPaddDiv = $('.pdf_con');
  const modalOverlay = $('.lm__modal-overlay');
  const modalCancel = $('.lm__modal-cancel');
  const modalConfirm = $('.lm__modal-confirm');

  function startAddingNote() {
    isAddingNote = true;
    leftDiv.off('mouseup', handleTextSelection);
  }

  function finishAddingNote() {
    isAddingNote = false;
    leftDiv.on('mouseup', handleTextSelection);
  }

  function isSameElement(node1, node2) {
    return node1 && node2 && node1.parentElement === node2.parentElement;
  }

  function handleTextSelection() {
    const selection = window.getSelection();
    if ($.contains(leftDiv[0], selection.anchorNode) && $.contains(leftDiv[0], selection.focusNode)) {
      if (!selection.isCollapsed && !isAddingNote && isSameElement(selection.anchorNode, selection.focusNode)) {
        startAddingNote();

        const range = selection.getRangeAt(0);
        const selectedText = range.toString();

        if (selectedText.trim() !== "") {
          const noteButton = $('<button>', {
            text: 'Add Note',
            class: 'add-note-button',
            click: function() {
              const noteDiv = $('<div>', { class: 'note' });
              noteId++;
              const noteIdText = `note-${noteId}`;
              noteDiv.attr('id', noteIdText);

              const noteHeading = $('<h2>', { text: selectedText });
              const noteContentDiv = $('<div>', { class: 'note-content' });
              const noteTextArea = $('<textarea>', { style: 'display: block;' });

              noteTextArea.on('input', function() {
                $(this).css('height', 'auto').css('height', this.scrollHeight + 'px');
              });

              const deleteButton = $('<a>', {
                text: '',
                class: 'delete-button',
              });

              const currentTimeSpan = $('<span>', { text: getCurrentTime() });

              deleteButton.click(function() {
                showModal(noteDiv);
              });

              noteContentDiv.append(noteTextArea, deleteButton, currentTimeSpan);
              noteDiv.append(noteHeading, noteContentDiv);
              pdfPaddDiv.append(noteDiv);

              noteButton.remove();

              const spanWrapper = $('<a>', { class: 'highlight anchor-text', href: `#${noteIdText}` });
              spanWrapper.append(noteButton).append(document.createTextNode(selectedText));

              range.deleteContents();
              range.insertNode(spanWrapper[0]);

              selection.removeAllRanges();

              finishAddingNote();
              noteButton.remove();
            }
          });

          const wrapper = $('<span>').append(range.extractContents()).append(noteButton);
          range.deleteContents();
          range.insertNode(wrapper[0]);

          selection.removeAllRanges();
        }
      }
    }
  }

  leftDiv.on('mouseup', handleTextSelection);

  modalCancel.on('click', function() {
    hideModal();
  });

  modalConfirm.on('click', function() {
    if (noteToDelete) {
      const selectedText = noteToDelete.find('h2').text();

      const anchorTags = leftDiv.find('.anchor-text');
      anchorTags.each(function() {
        if ($(this).text() === selectedText) {
          $(this).parent().replaceWith(document.createTextNode(selectedText));
        }
      });

      noteToDelete.remove();
      hideModal();
    }
  });

  pdfPaddDiv.on('keyup', function() {
    // performAction(); // Uncomment and add your action if needed
  });

  rightDiv.on('click', function(event) {
    const highlightedElements = leftDiv.find('.highlight');
    highlightedElements.removeClass('highlight active');

    const notes = pdfPaddDiv.find('.note');
    notes.removeClass('active');
  });

  // Event delegation for the delete button
  pdfPaddDiv.on('click', '.delete-button', function() {
    const noteDiv = $(this).closest('.note');
    showModal(noteDiv);
  });

  function showModal(noteDiv) {
    noteToDelete = noteDiv;
    modalOverlay.css('display', 'block');
  }

  function hideModal() {
    noteToDelete = null;
    modalOverlay.css('display', 'none');
  }

  function getCurrentTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    return `${hours}:${minutes}`;
  }
});
  
  function performAction(interactive_workbook_id)
  {
    let _token = $("input[name=_token]").val();
    let content = $("#pdf_con_"+interactive_workbook_id).html(); 
    console.log(interactive_workbook_id);
    console.log(content);
    var user_id = $("#auth_user_id").val();
    
    var formData = new FormData($(".AddInteractiveUserDetailsForm")[0]);
    formData.set('interactive_workbook_id', interactive_workbook_id);
    formData.set('user_id', user_id);
  
    formData.set('content', content);
    
    $.ajax({
        url: "{{route('interactive.detail.add')}}"
        , type: "POST"
        , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        , data: formData
        , dataType: 'JSON'
        , contentType: false // Set content type to false for file upload
        , processData: false 
        , success: function(data) {
            console.log(data);
            if (data.error) {
                console.log(data.error);
                return false;
            } else if (data.status == "200")
            {
              var success_message = data.message;
              console.log(success_message);
              
              var success_message = data.message;
                    
              Swal.fire({
                  toast: true,
                  icon: 'success', // 'warning', 'info', etc.
                  title: success_message,
                  position: 'top-right',
                  showConfirmButton: false,
                  timer: 2000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer);
                      toast.addEventListener('mouseleave', Swal.resumeTimer);
                  }
              });
            }
                        
        },
        error: function(xhr, status, error) {
          var errorMessage = "An error occurred. Please try again."; // Default error message
          if (xhr.responseJSON && xhr.responseJSON.message)
          {
            errorMessage = xhr.responseJSON.message; // Use the error message from the API response
            console.log(errorMessage);
          }
        }
    });
    
  } // End function 
            
  $(document).ready(function() {    
    // Select all textarea elements with the pdf_con class
    $('.AddInteractiveUserDetailsForm textarea').each(function() {
        // Add the onkeyup attribute to each textarea
        $(this).attr('onkeyup', "$(this).html($(this).val().replace(/ik/g,'b'));");
    });
  });
</script>

<script src="{{ asset('assets/js/green-audio-player.js')}}"></script>
@if (isset($audio_recording))
<script>
  document.addEventListener('DOMContentLoaded', function () {
      GreenAudioPlayer.init({
          selector: '.player',
          stopOthersOnPlay: true
      });

      GreenAudioPlayer.init({
          selector: '.player-with-download',
          stopOthersOnPlay: true,
          showDownloadButton: true,
          enableKeystrokes: true
      });

      GreenAudioPlayer.init({
          selector: '.player-with-accessibility',
          stopOthersOnPlay: true,
          enableKeystrokes: true
      });
  });
</script>
@endif
</html>