@foreach ($moduleData as $i=>$courseData )
{{-- {{ dd($courseData['course_completed_progress']) }} --}}

@php

    $collapsed = $courseData['mark_as_complete'] === 1 ? '' : 'collapsed';
    // $collapsed = 'collapsed';
    
    // $showClass = $courseData['mark_as_complete'] === 1 ? 'show' : 'collapse';
    $showClass = ($courseData['mark_as_complete'] === 1 || $courseData['introduction'] === 1) ? 'show' : 'collapse';
    
    $whenIntroShowClass = '';
    // dd($courseData);
    if($courseData['introduction']==1)
    {
      $whenIntroShowClass = 'collapse show';
    }
    
@endphp
    

<div class="accordion-item">
    <h2 class="accordion-header">
      <button onclick="showModuleOverview('{{ $courseData['thumbnail_image'] }}')" class="accordion-button {{ $collapsed }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $i }}" aria-expanded="true" aria-controls="collapseOne{{ $i }}">
        {{ $courseData['title'] }}
      </button>
    </h2>
    <div id="collapseOne{{ $i }}" class="accordion-collapse {{ $showClass }}" data-bs-parent="#pq_accordionExample">
      <div class="accordion-body p-0">
        <!-- progress -->
        
        @if(Auth::user()->is_admin!=1)
        <div class="progress-wrap">
          <p class="text-end color-light mb-0 text-sm-12">{{ $courseData['course_completed_progress'] }}% Completed</p>
          <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="{{ $courseData['course_completed_progress'] }}" aria-valuemax="100" style="height: 4px">
            <div class="progress-bar" style="width: {{ $courseData['course_completed_progress'] }}%"></div>
          </div>
        </div>
        @endif
        
        @foreach ($courseData['course_sub_module'] as $index => $subModule)
        
        <script type="text/javascript">
          
            var initialize = "{{ $i }}";
            var status = "{{ $subModule['status'] }}";
            if(status ==1)
            {
                var course_module_id = "{{ $courseData['id'] }}";
                var complete_type = "{{ $subModule['type'] }}";
                var next_type = "{{ $subModule['next_type'] }}";
                var course_id = "{{ $courseData['course']->id }}";
                var numberOfModules = "{{count($moduleData)}}";
                var runningModuleCount = "{{ $i+1 }}";
                showSubModulePreview(course_module_id, complete_type, next_type, course_id,status, numberOfModules, runningModuleCount,'',initialize);
            }
        </script>
        @php
            $isActive = '';
            if($subModule['status']==1)
            {
                // $isActive = ($i === 0 && $index === 0) ? 'active' : '';
                $isActive = 'active';
            }
            $iconSrc = '';
            $disabled = '';
            $ontap_css='';
            if ($subModule['status'] == 1) {
                $iconSrc = asset('assets/images/play-btn.svg');
                $ontap_css ='tala_chalu';
            } elseif ($subModule['status'] == 2) {
                $iconSrc = asset('assets/images/check.svg');
                $ontap_css ='tala_khalu';
            } elseif ($subModule['status'] == 0) {
                $iconSrc = asset('assets/images/lockr.svg');
                $ontap_css ="tala_band";
                $disabled = 'true';
            }
        
        if(Auth::user()->is_admin==1)
        {
            $iconSrc = asset('assets/images/play-btn.svg');
        }
        @endphp
        
            <a class="course-con-list-item {{ $isActive }} {{ $ontap_css }}">
            {{-- <div class="d-flex align-items-center justify-content-between"> --}}
             @if(Auth::user()->is_admin==1)   
                <div class="d-flex align-items-center justify-content-between" onclick="showSubModulePreview({{ $courseData['id'] }}, '{{ $subModule['type'] }}', '{{ $subModule['next_type'] }}', {{ $courseData['course']->id }}, {{ $subModule['status'] }})">
                    
                    {{-- <div class="d-flex align-items-center justify-content-between" @if ($subModule['status'] == 1 || $subModule['status'] == 2) onclick="showSubModulePreview({{ $courseData['id'] }}, '{{ $subModule['type'] }}', '{{ $subModule['next_type'] }}', {{ $courseData['course']->id }}, {{ $subModule['status'] }})" @endif> --}}
            @else
            @if ($subModule['status'] == 1 || $subModule['status'] == 2)
                <div class="d-flex align-items-center justify-content-between" onclick="showSubModulePreview({{ $courseData['id'] }}, '{{ $subModule['type'] }}', '{{ $subModule['next_type'] }}', {{ $courseData['course']->id }}, {{ $subModule['status'] }})">
            @else
                <div class="d-flex align-items-center justify-content-between" onclick="warningMessage({{ $subModule['status'] }})">
            @endif
                
            @endif
                @if($isActive)
                <input type="hidden" value="{{ $courseData['id'] }}" id="course_module_id" >
                <input type="hidden" value="{{$courseData['course']->id  }}" id="course_id" >
                <input type="hidden" value="{{$subModule['next_type']  }}" id="next_type" >
                <input type="hidden" value="{{$subModule['type']  }}" id="complete_type" >
                <input type="hidden" value="{{ count($moduleData)  }}" id="numberOfModules" >
                <input type="hidden" value="{{ $i+1  }}" id="runningModuleCount" >
                    
                @endif
                <div class="d-flex align-items-center">
                <div class="icon-div">
                    <span class="icon">
                    <img class="in-svg" src="{{ $iconSrc }}">
                    </span>
                </div>
                <p class="mb-0">{{ $subModule['name'] }}</p>
                </div>
                {{-- <span class="mb-0 text-sm-12">2:25</span> --}}
            </div>
            </a>
        @endforeach
        
        {{-- <a class="course-con-list-item" href="">
          <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <div class="icon-div"> <span class="icon"><img class="in-svg" src="{{asset('assets/images/lockr.svg')}}" alt=""></span></div>
              <p class="mb-0">Closure Video</p>
            </div>
            <span class="mb-0 text-sm-12">5:25</span>
          </div>
        </a> --}}
        
        
      </div>
    </div>
  </div>
  @endforeach

  <script>
    function playAudio(audioFile){
      const audioPlayer = document.querySelector(".audio-player");
      const audio = new Audio(
        audioFile
      );
  
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
  </script>

@if(Auth::user()->is_admin==1)
<script type="text/javascript">
  $(".course-con-list-item").click(function() {
    var is_lock=(this.classList.contains("tala_chalu"));
    $(".course-con-list-item").removeClass("active");
    // alert(is_lock);
    if(!is_lock) 
    {
    $(this).siblings(".course-con-list-item").removeClass("active");
    $(this).toggleClass("active");  
    }
    
  });
  </script>
@else
<script type="text/javascript">
$(".course-con-list-item").click(function() {
  var is_lock=(this.classList.contains("tala_band"));
  $(".course-con-list-item").removeClass("active");
  // alert(is_lock);
  if(!is_lock) 
  {
  $(this).siblings(".course-con-list-item").removeClass("active");
  $(this).toggleClass("active");  
  }
  
});
</script>

@endif
<script>

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

</script>