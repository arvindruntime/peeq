@extends('layouts.admin.master')
@section('content')
<style>
.fr-box.fr-basic.fr-top label {
    font-size:14px !important;
}
</style>
<main class="main-content" id="main">
    <section class="lm__dash-con mb-5 lm__module-add">
        <span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark"
                src="{{ asset('assets/images/dark.png') }}" alt=""></span>
        <div class="container">
            <div class="row lm__module-add-con">
                <div class="col-12">
                    <div class="mb-3">
                        <a href="{{ route('admin.courses.inner', ['id' => $courseModule->course_id]) }}" class="btn btn--primary rounded-4 py-2">Go Back</a>
                    </div>
                    <div class="lm__module-title">
                        <h3 class="fw-bold">Edit Module</h3>
                    </div>
                    <div class="page-ath-wrap">
                        <div class="page-ath-content register-form-content">
                            <div class="page-ath-form">
                                <div class="form-align-box">
                                    <div class="wizard">
                                        <!-- Step -->
                                        <div class="wizard-inner">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <!-- 1 -->
                                                <li role="presentation">
                                                    <a href="#step1" class="active" data-toggle="tab"
                                                        aria-controls="step1" role="tab" aria-expanded="true"
                                                        data-step="1">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Introduction</p>
                                                    </a>
                                                </li>
                                                <!-- 2 -->
                                                <li role="presentation">
                                                    <a href="#step2" class="disabled" data-toggle="tab"
                                                        aria-controls="step2" role="tab" aria-expanded="false"
                                                        data-step="2">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Video Lesson</p>
                                                    </a>
                                                </li>
                                                <!-- 3 -->
                                                <li role="presentation">
                                                    <a href="#step3" class="disabled" data-toggle="tab"
                                                        aria-controls="step3" role="tab" data-step="3">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Audio</p>
                                                    </a>
                                                </li>
                                                <!-- 4 -->
                                                <li role="presentation">
                                                    <a href="#step4" class="disabled" data-toggle="tab"
                                                        aria-controls="step4" role="tab" data-step="4">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Task</p>
                                                    </a>
                                                </li>
                                                <!-- 5 -->
                                                <li role="presentation">
                                                    <a href="#step5" class="disabled" data-toggle="tab"
                                                        aria-controls="step5" role="tab" data-step="5">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Quiz</p>
                                                    </a>
                                                </li>
                                                <!-- 6 -->
                                                <li role="presentation">
                                                    <a href="#step6" class="disabled" data-toggle="tab"
                                                        aria-controls="step6" role="tab" data-step="6">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Questions</p>
                                                    </a>
                                                </li>
                                                <!-- 7 -->
                                                <li role="presentation">
                                                    <a href="#step7" class="disabled" data-toggle="tab"
                                                        aria-controls="step7" role="tab" data-step="7">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Reference Links</p>
                                                    </a>
                                                </li>
                                                <!-- 8 -->
                                                <li role="presentation">
                                                    <a href="#step8" class="disabled" data-toggle="tab"
                                                        aria-controls="step8" role="tab" data-step="7">
                                                        <span class="round-tab"></span>
                                                        <p class="mb-0 wizard-title text">Closing Video</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- From -->
                                        <div class="tab-content" id="main_form">
                                            <!-- 1 -->
                                            <div class="tab-pane active" role="tabpanel" id="step1">
                                                <div class="lm__module-card card">
                                                    <div class="row">


                                                        <form action="#" name="CourseModuleSaveForm"
                                                            id="CourseModuleSaveSection1Form" method="post"
                                                            enctype="multipart/form-data">
                                                            <input type="hidden" name="course_module_id"
                                                                id="course_module_id" value="{{ $courseModule->id }}" />
                                                            <input type="hidden" name="course_id" id="course_id"
                                                                value="{{$courseModule->course_id }}" />
                                                                <input type="hidden" name="checking_completed" id="checking_completed" />
                                                            <div class="col-12">
                                                                <div class="lm__module-form">
                                                                    <label class="form-label mb-1" for="title">Module
                                                                        Title </label>
                                                                    <input class="form-control shadow py-2" name="title"
                                                                        id="title" type="text" placeholder="Title"
                                                                        value="{{ $courseModule->title }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="lm__module-form">
                                                                    <label class="form-label thumb mb-1"
                                                                        for="thumbnail_image">Thumbnail Image</label>
                                                                    <p class="mb-2 text-sm-14">Choose what image to
                                                                        display in the Module thumbnail view. The
                                                                        thumbnail image provides visual appeal and will
                                                                        make this Module easier to recognize.</p>
                                                                    @if($courseModule->thumbnail_image!='')
                                                                    <img src="{{ $courseModule->thumbnail_image }}" class="course_module_thumbnail_image_preview mb-2" width="100" height="100">
                                                                    @endif
                                                                    <label for="thumbnail_image"
                                                                        class="position-relative thumb">
                                                                        <input class="form-control" name="thumbnail_image" id="thumbnail_image" type="file" accept=".png, .jpg, .jpeg">
                                                                        <input name="thumbnail_image_tmp" id="thumbnail_image_tmp" type="hidden" value="{{ $courseModule->thumbnail_image }}">
                                                                        <span
                                                                            class="position-absolute top-50 start-50 translate-middle text-dark text-sm-14 text-center title-font text-nowrap">Upload
                                                                            Thumbnail</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="lm__module-form mb-0">
                                                                    <label
                                                                        class="form-label thumb mb-1">Introduction</label>
                                                                    <div class="lm__module-form mb-0">
                                                                        <textarea class="ckplot1" id="introduction"
                                                                            name="introduction"
                                                                            placeholder="Introduction">{{ $courseModule->introduction }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Button -->
                                                            <div class="col-12">
                                                                <div class="lm__module-button text-end">
                                                                    <a class="btn btn--primary next-step CourseModuleSaveBtn"
                                                                        data-id="{{$courseModule->id}}">Next</a>
                                                                </div>
                                                            </div>
                                                            {{--
                                                        </form> --}}
                                                    </div>
                                                </div>


                                            </div>
                                            <!-- 2 -->
                                            <div class="tab-pane" role="tabpanel" id="step2">
                                                <div class="lm__module-card card">
                                                    <div class="row">
                                                        {{-- <form action="#" name="CourseModuleVideoSessionSaveForm"
                                                            id="CourseModuleVideoSessionSaveForm" method="post"
                                                            enctype="multipart/form-data"> --}}

                                                            <div class="col-12">
                                                                <div class="lm__module-form mb-0 ">
                                                                    <label class="form-label thumb mb-2">Video
                                                                        Lesson</label>
                                                                    <div class="lm__module-form mb-0">
                                                                        <div class="editor-container">
                                                                            <textarea class="ckplot" name="video_lesson"
                                                                                id='video_lesson'
                                                                                placeholder="Upload video lesson here ...">{{ $courseModule->video_lesson }}</textarea>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Button -->
                                                            <div class="col-12">
                                                                <div class="lm__module-button text-end">
                                                                    <a
                                                                        class="btn btn--primary videoBtn   CourseModuleSaveBtn">Next</a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 3 -->
                                            <div class="tab-pane" role="tabpanel" id="step3">
                                                <div class="lm__module-card card">
                                                    <div class="row">
                                                        {{-- <form action=""> --}}

                                                            <div class="col-12">
                                                                <div class="lm_audio mb-4">
                                                                    <h6 class="mb-1">Audio Recording</h6>
                                                                    <p class="mb-0">Choose what audio to play in the
                                                                        Module..</p>
                                                                    <div class="lm__module-form mb-0 ">
                                                                        <div class="lm__module-form mb-0">
                                                                            <textarea class="ckplot"
                                                                                id="audio_recording_description"
                                                                                name="audio_recording_description"> {{ $courseModule->audio_recording_description }} </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="lm__module-form">
                                                                    <label class="form-label thumb mb-1"
                                                                        for="audio_recording">Audio Recording</label>
                                                                    <p class="mb-2 text-sm-14">Choose what audio to play in the Module.</p>
                                                                    
                                                                    
                                                                    @if ($courseModule->audio_recording)
                                                                    
                                                                    <div class="audioWaliDiv d-flex gap-2 align-items-end">
                                                                        <div class="lm_audio w-100">
                                                                          <div class="lm_audio-card">
                                                                            <div class="audio-player">
                                                                              <div class="timeline">
                                                                                <div class="progress"></div>
                                                                              </div>
                                                                              <div class="controls">
                                                                                <div class="play-container">
                                                                                  <div class="toggle-play play">
                                                                                  </div>
                                                                                </div>
                                                                                <div class="time">
                                                                                  <div class="current">0:00</div>
                                                                                  <div class="divider1">/</div>
                                                                                  <div class="length"></div>
                                                                                </div>
                                                                                <div class="volume-container">
                                                                                  <div class="volume-button">
                                                                                    <div class="volume icono-volumeMedium">
                                                                                      <img class="unmute" src="https://i.ibb.co/gRwV26r/volume.png" alt="">
                                                                                      <img class="mute" src="https://i.ibb.co/rZWg6ZV/mdi-volume-mute.png" alt="mdi-volume-mute">
                                                                                    </div>
                                                                                  </div>
                                                        
                                                                                  <div class="volume-slider">
                                                                                    <div class="volume-percentage"></div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div> 
                                                                        <a class="removethumbnailAudio bg-white-42 shadow"> <img class="in-svg" src="{{ asset('assets/images/delete-fill.svg') }}" alt=""> </a>
                                                                    </div>
                                                                    
                                                                    <script type="text/javascript">
                                                                        playAudio('{{ $courseModule->audio_recording }}');
                                                                        
                                                                    </script>
                                                                    
                                                                    @else
                                                                    <div class="audioWaliDiv d-none d-flex gap-2 align-items-end">
                                                                        <div class="lm_audio mb-4 w-100">
                                                                          <div class="lm_audio-card">
                                                                            <div class="audio-player">
                                                                              <div class="timeline">
                                                                                <div class="progress"></div>
                                                                              </div>
                                                                              <div class="controls">
                                                                                <div class="play-container">
                                                                                  <div class="toggle-play play">
                                                                                  </div>
                                                                                </div>
                                                                                <div class="time">
                                                                                  <div class="current">0:00</div>
                                                                                  <div class="divider1">/</div>
                                                                                  <div class="length"></div>
                                                                                </div>
                                                                                <div class="volume-container">
                                                                                  <div class="volume-button">
                                                                                    <div class="volume icono-volumeMedium">
                                                                                      <img class="unmute" src="https://i.ibb.co/gRwV26r/volume.png" alt="">
                                                                                      <img class="mute" src="https://i.ibb.co/rZWg6ZV/mdi-volume-mute.png" alt="mdi-volume-mute">
                                                                                    </div>
                                                                                  </div>
                                                        
                                                                                  <div class="volume-slider">
                                                                                    <div class="volume-percentage"></div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div> 
                                                                        <a class="removethumbnailAudio bg-white-42 shadow"> <img class="in-svg" src="{{ asset('assets/images/delete-fill.svg') }}" alt=""> </a>
                                                                    </div>
                                                                    @endif
                                                                
                                                                    
                                                                    <br><label for="audio_recording"
                                                                        class="position-relative thumb">
                                                                        
                                                                            <input class="form-control" name="audio_recording" id="audio_recording" type="file" accept=".mp3, .wav">
                                                                            <span id="audioRecording"></span>
                                                                            
                                                                        <span
                                                                            class="position-absolute top-50 start-50 translate-middle text-dark text-sm-14 text-center title-font text-nowrap">Upload
                                                                            Audio Recording</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            {{--
                                                        </form> --}}
                                                        <!-- Button -->
                                                        <div class="col-12">
                                                            <div class="lm__module-button text-end">
                                                                <a class="btn btn--dark next-step me-2 mt-4">Skip</a>
                                                                <a
                                                                    class="btn btn--primary next-step CourseModuleSaveBtn mt-4">Next</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 4 -->
                                            <div class="tab-pane" role="tabpanel" id="step4">
                                                <div class="lm__module-card card">
                                                    <div class="row">
                                                        {{-- <form action=""> --}}

                                                            <div class="col-12">
                                                                <div class="lm__module-form mb-0 ">
                                                                    <label class="form-label thumb mb-2">Task</label>
                                                                    <div class="lm__module-form mb-0">
                                                                        <textarea class="ckplot" name="task"
                                                                            id="task"> {{ $courseModule->task }} </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                              <div class="lm-workbook-wrap">
                                                                <a class="addInteractive" target="_blank">
                                                                  <div class="lm-workbook">
                                                                    <img src="{{asset('assets/images/icon-pdf.svg')}}" alt="">
                                                                    <span>Interactive Workbook</span>
                                                                  </div>
                                                                </a>
                                                              </div>
                                                              
                                                            {{--
                                                        </form> --}}
                                                        <!-- Button -->
                                                        <div class="col-12">
                                                            <div class="lm__module-button text-end">
                                                                <a
                                                                    class="btn btn--primary taskBtn CourseModuleSaveBtn">Next</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 5 -->
                                            <div class="tab-pane" role="tabpanel" id="step5">
                                                <div class="lm__module-card card">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="lm__module-form mb-0 ">
                                                                <label class="form-label thumb mb-2">Quiz
                                                                    Description</label>
                                                                <div class="lm__module-form mb-0">
                                                                    <div class="editor-container">
                                                                        <textarea class="ckplot" name="quiz_description"
                                                                            id='quiz_description'
                                                                            placeholder="Upload quiz description here ...">{{ $courseModule->quiz_description }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <h5>Quiz</h5>
                                                            <p class="mb-2 text-sm-14">Create a quiz for particular
                                                                module.</p>
                                                            {{-- <div class="quiz-bg bg-primary p-2">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <h5 class="mb-0">Quiz - 1</h5>
                                                                    <div class="d-flex gap-2 align-items-center">
                                                                        <span class="eye-close">
                                                                            <img class="in-svg close"
                                                                                src="{{ asset('assets/images/eye-off.svg') }}"
                                                                                alt="">
                                                                            <img class="in-svg open"
                                                                                src="{{ asset('assets/images/eye-on.svg') }}"
                                                                                alt="">
                                                                        </span>
                                                                        <a class="btn btn--white py-2"
                                                                            href="{{ route('admin.courses.add.module', ['id' => $id]) }}">Edit</a>
                                                                    </div>
                                                                </div>

                                                            </div> --}}
                                                        </div>
                                                        {{-- <form action=""> --}}
                                                            <div class="col-12">
                                                                <a class="lm__module-form d-block" href="{{ route('admin.quiz.create', ['course_id' => $courseModule->course_id, 'course_module_id' => $courseModule->id]) }}"
                                                                    target="_blank">
                                                                    <label for="formFile4"
                                                                        class="position-relative thumb quiz-thumb">
                                                                        <input class="form-control bg-transparent"
                                                                            id="formFile4" type="button">
                                                                        <span
                                                                            class="position-absolute top-50 start-50 translate-middle text-dark text-sm-14 text-center title-font text-nowrap d-flex gap-2 quiz-mod">Create
                                                                            Quiz <span>
                                                                                <img class="in-svg"
                                                                                    src="{{ asset('assets/images/plus.svg') }}"
                                                                                    alt=""></span>
                                                                                    
                                                                        </span>
                                                                    </label>
                                                                </a>
                                                            </div>
                                                            {{--
                                                        </form> --}}
                                                        <!-- Button -->
                                                        <div class="col-12">
                                                            <div class="lm__module-button text-end">
                                                                <a
                                                                    class="btn btn--primary next-step CourseModuleSaveBtn">Next</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 6 -->
                                            <div class="tab-pane" role="tabpanel" id="step6">
                                                <div class="lm__module-card card">
                                                    <div class="row">
                                                        {{-- <form action=""> --}}

                                                            <div class="col-12">
                                                                <div class="lm__module-form mb-0 ">
                                                                    <label class="form-label mb-2">Reflection
                                                                        questions</label>
                                                                    <div class="lm__module-form mb-0">
                                                                        <textarea class="ckplot"
                                                                            id="reflection_questions"
                                                                            name="reflection_questions"> {{ $courseModule->reflection_questions }} </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--
                                                        </form> --}}
                                                        <!-- Button -->
                                                        <div class="col-12">
                                                            <div class="lm__module-button text-end">
                                                                <a
                                                                    class="btn btn--primary reflextionBtn CourseModuleSaveBtn">Next</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 7 -->
                                            <div class="tab-pane" role="tabpanel" id="step7">
                                                <div class="lm__module-card card">
                                                    <div class="lm__ref">
                                                        <div class="lm__ref-title">
                                                            <h5>Reference Links</h5>
                                                            <p class="text-sm-14">Add links related to the module for reference.</p>
                                                        </div>
                                                        {{-- <form action=""> --}}
                                                            <div class="col-12">
                                                                <div class="lm__module-form mb-3 ">
                                                                    <div class="lm__module-form mb-0">
                                                                        <textarea class="ckplot" id="reference_link_description" name="reference_link_description"> {{ $courseModule->reference_link_description }} </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <div class="lm__module-form w-100">
                                                                {{-- <div class="row">
                                                                    <div class="col-4 ps-0">
                                                                        <input class="form-control shadow py-2" type="text" placeholder="Related Title" name="reference_title[]">
                                                                    </div>
                                                                    <div class="col-7 pe-0">
                                                                        <input class="form-control shadow py-2" type="text" placeholder="Related Links" name="reference_link[]">
                                                                    </div>
                                                                    <div class="col-1 pe-0">
                                                                        <div class="lm_form-add flex-shrink-0 ms-0">
                                                                            <span class="add">
                                                                                <img class="in-svg" src="{{ asset('assets/images/plus-quiz.svg') }}" alt="">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div> --}}
                                                                 {{-- <div class="d-flex gap-3 align-items-center">
                                                                    
                                                                    <input class="form-control shadow py-2" type="text" placeholder="Related Title" name="reference_title[]">
                                                                    
                                                                    <input class="form-control shadow py-2" type="text" placeholder="Related Links" name="reference_link[]"> 
                                                                    
                                                                    <div class="lm_form-add flex-shrink-0 ms-0">
                                                                        <span class="add">
                                                                            <img class="in-svg" src="{{ asset('assets/images/plus-quiz.svg') }}" alt="">
                                                                        </span>
                                                                    </div>
                                                                    
                                                                </div> --}}
                                                            </div>
                                                            
                                                            @php
                                                            $reference_titleArray = explode(',', $courseModule->reference_title);
                                                            $reference_linkArray = explode(',', $courseModule->reference_link);
                                                            $i = 1;
                                                            $j = 0;
                                                            @endphp
                                                            @foreach($reference_linkArray as $k => $oldLink)
                                                            @if(!empty($oldLink))  
                                                            <span class="mb-3 d-block" id="reference_link_dynamic{{ $i }}">
                                                                <div class="d-flex gap-3">
                                                                    <input class="form-control shadow py-2" type="text" name="reference_title[]" placeholder="Reference title" value="{{ $reference_titleArray[$j] }}">
                                                                    <input class="form-control shadow py-2" type="text" name="reference_link[]" placeholder="Reference Links" value="{{ $oldLink }}">
                                                                    @if($k==0)
                                                                        <div class="lm_form-add flex-shrink-0 ms-0">
                                                                            <span class="add">
                                                                                <img class="in-svg" src="{{ asset('assets/images/plus-quiz.svg') }}" alt="">
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <span class="lm_form-add shadow flex-shrink-0 ms-0 remove_added_dynamic" id="{{ $i }}">
                                                                            <img src="{{ asset('assets/images/trash.svg') }}" alt="">
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </span>
                                                            @php $i++; $j++@endphp
                                                            @endif
                                                            @endforeach
                                                            
                                                            <div class="append_related_link"></div>
                                                            

                                                            <div class="col-12">
                                                                <div class="lm__module-button text-end">
                                                                    <a
                                                                        class="btn btn--primary reference_linkBtn CourseModuleSaveBtn">Next</a>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 8 -->
                                            <div class="tab-pane" role="tabpanel" id="step8">
                                                <div class="lm__module-card card">
                                                    <div class="lm__ref">
                                                        <div class="lm__ref-title">
                                                            <h5>Closing Video</h5>
                                                        </div>
                                                    
                                                        <div class="col-12">
                                                            <div class="lm__module-form mb-3 ">
                                                                <div class="lm__module-form mb-0">
                                                                    {{-- <textarea class="ckplot" id="closure_video_description" name="closure_video_description"> {{ $courseModule->closure_video_description }} </textarea> --}}
                                                                    <textarea class="ckplot" id="closure_video_description" name="closure_video"> {{ $courseModule->closure_video }} </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- <div class="col-12">
                                                            <div class="lm__module-form">
                                                                <label class="form-label thumb mb-1"
                                                                    for="closure_video">Closing Video</label>
                                                                <p class="mb-2 text-sm-14">Choose what video to display
                                                                    in the Module end. The Closing video is not
                                                                    mandatory.</p>
                                                    @if($courseModule->closure_video != '')
                                                        <p>
                                                            <div class="d-flex gap-2 align-items-end video_thumbnailContainer">
                                                                <video id="video_thumbnailURL" width="200" height="200" controls>
                                                                    <source src="{{ $courseModule->closure_video }}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                                <a class="removethumbnailVideo bg-white-42 shadow"> <img class="in-svg" src="{{ asset('assets/images/delete-fill.svg') }}" alt=""> </a>
                                                            </div>
                                                        </p>
                                                     @else
                                                        <p>
                                                            <div class="d-flex gap-2 align-items-end video_thumbnailContainer d-none">
                                                                <video id="video_thumbnailContainer" class="d-none" width="200" height="200" controls>
                                                                    <source src="" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                                <a class="removethumbnailVideo bg-white-42 shadow"> <img class="in-svg" src="{{ asset('assets/images/delete-fill.svg') }}" alt=""> </a>
                                                            </div>
                                                        </p>
                                                    @endif
                                                                <label for="closure_video"
                                                                    class="position-relative thumb">
                                                                    <input class="form-control" name="closure_video" id="closure_video" type="file" accept="video/mp4,video/avi,video/quicktime,video/webm">
                                                                    <input name="closure_video_tmp" id="closure_video_tmp" type="hidden" value="{{ $courseModule->closure_video }}">
                                                                    <span
                                                                        class="position-absolute top-50 start-50 translate-middle text-dark text-sm-14 text-center title-font text-nowrap">Upload
                                                                        Closing Video</span>
                                                                    </label>
                                                            </div>
                                                        </div> --}}

                                                        <!-- Button -->
                                                        <div class="col-12">
                                                            <div class="lm__module-button text-end">
                                                                <a id="myButton" href="{{ route('user.courses.intro', ['course_id' => $courseModule->course_id, 'course_modules' => '']) }}"></a>
                                                                <a
                                                                    class="btn btn--primary closure_video CourseModuleSaveBtn">Save</a>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<script>
    $(document).ready(function() {

            /// Course Module Section1 Form

            $('.CourseModuleSaveBtn').click(function(e) {
                console.log("Form submited");
                e.preventDefault();
                // var formData  = $("#contact-support").serialize()         
                let _token = $("input[name=_token]").val();
                let formName = "#CourseModuleSaveSection1Form";
                var formData = new FormData($(formName)[0]);
                
                // Start Code to remove Audio 
                var audio_recording_tmp = $("#audio_recording_tmp").val();
                var fileInput = $("#audio_recording")[0]; // Get the DOM element
                var files = fileInput.files; // Get the selected files
                if (files.length < 1 && (audio_recording_tmp=="removed")) {
                    
                    var newFormData = new FormData($(formName)[0]);
                    newFormData.delete('audio_recording');
                    // Update the original FormData object
                    formData = newFormData;
                    // Clear the file input field
                    $('#audio_recording').val('');
        
                    formData.append('audio_recording', ''); 
                }
                // End Code to remove Audio 
                
                
                //// code added for reference_title
                var reference_title = $("input[name='reference_title[]']").map(function() {
                    return $(this).val();
                }).get();

                var reference_titleCSV = reference_title.join(',');
                formData.append('reference_title', reference_titleCSV); 
                ////////////////////////////
                
                console.log(reference_titleCSV);
                                
                var reference_link = $("input[name='reference_link[]']").map(function() {
                    return $(this).val();
                }).get();

                var reference_linkCSV = reference_link.join(',');
                formData.append('reference_link', reference_linkCSV);               
                
                console.log(reference_linkCSV);

                var courseModuleId = $("#course_module_id").val();
                var update_url = "{{ route('admin.courses.update.module', ':id') }}";
                update_url = update_url.replace(':id', courseModuleId);
                
                console.log(formData);
                $.ajax({
                    url: update_url,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    dataType: 'JSON',
                    contentType: false // Set content type to false for file upload
                        ,
                    processData: false,
                    success: function(data) {
                        // $(".CourseModuleSaveBtn").attr("disabled", false);
                        console.log(data);
                        if (data.error) {
                            // $(".CourseModuleSaveBtn").attr("disabled", false);
                            printErrorMsg(data.error);
                            return false;
                        } else if (data.status == "200") {
                            
                            $('input[name="course_module_id"]').val(data.data.id);
                            
                            course_id = data.data.course.id;
                            
                            var course_module_id = data.data.id;

                            var course_module_id =$("#course_module_id").val();
                            var id = course_module_id;
                            var url = "{{ route('admin.courses.overview', ":id") }}";
                            url = url.replace(":id", id);
                            var checking_completed = $("#checking_completed").val();
                            // setInterval(function() {
                            //     if($("#step8").hasClass('active')) {
                            //         if(checking_completed == 1) {
                            //             window.location.href = url;
                            //         }
                            //     }
                            // }, 5000);

                            var urlTemplate = "{{ route('admin.quiz.create') }}" +
                                "?course_id=" + course_id + "&course_module_id=" +
                                course_module_id;
                            // Set the href attribute of the element with the class "createQuiz"
                            $('.createQuiz').attr('href', urlTemplate);
                            
                            // var url = "{{ route('admin.interactive.add', ['course_id' => ':course_id', 'course_module_id' => ':course_module_id']) }}";
                            // url = url.replace(':course_id', course_id).replace(':course_module_id', course_module_id);
                            
                            
                            var url = "{{ route('admin.interactive.list.workbook', ['courseModule' => ':courseModule']) }}";
                            url = url.replace(':courseModule', course_module_id);
                            
                            $(".addInteractive").attr('href', url);
                            
                            $('#errorField').text('');
                            
                            var url = "{{ route('user.courses.intro', ['course_id' => ':id', 'course_modules' => '']) }}";
                            url = url.replace(":id", course_id);
                            var checking_completed = $("#checking_completed").val();
                            if(checking_completed == 1) {
                                setInterval(function() {
                                    if($("#step8").hasClass('active')) {
                                        if(checking_completed == 1) {
                                            window.location.href = url;
                                        }
                                    }
                                }, 1000);
                            }
                        }
                    },
                    error: function(xhr, status, error) {

                        // $(".CourseModuleSaveBtn").attr("disabled", false);

                        var errorMessage =
                        "An error occurred. Please try again."; // Default error message
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            // console.log(xhr.responseJSON);
                            errorMessage = xhr.responseJSON
                            .message; // Use the error message from the API response
                        }
                        // Set the error message in the desired HTML tag
                        $('#errorField').text(errorMessage);
                        console.log(errorMessage);
                    }
                });
            });
            function printErrorMsg(msg) {
                console.log(msg);
                $.each(msg, function(key, value) {
                    $("#errorField").text(value);
                });
            }

            ///////////Started code to add dynamic Reference Links//////

            var i = 1
            $('.add').on('click', function() {
                i++;
                var link = '<span id="releted_link_static' + i + '"><div class="d-flex gap-3 align-items-center">'
                    
                    link +='<input class="form-control shadow py-2" type="text" placeholder="Related Title" name="reference_title[]">';
                link +=
                    '<input class="form-control shadow py-2" type="text" name="reference_link[]" placeholder="Related Links" value=""><br/><div class="lm_form-add ms-0"><span class="add" onclick="remove_added_related_link(' +
                    i +
                    ')"><img class="in-svg" src="{{ asset('assets/images/minus-quiz.svg') }}"alt=""></span></div>'
                link += '</div><br></span>'
                $('.append_releted_link').append(link)

                // console.log(link)
                ;
                return false;
            });
            /////////// Ended code of add dynamic Reference Links//////

        });


        function remove_added_related_link(id = '') {
            var button_id = id;
            $('#releted_link_static' + button_id + '').remove();
            return false;
        }
</script>

<script>
    $(document).ready(function() {
            const audioPlayer = document.querySelector(".audio-player");
            const audio = new Audio(
                "https://ia800905.us.archive.org/19/items/FREE_background_music_dhalius/backsound.mp3"
            );
            //credit for song: Adrian kreativaweb@gmail.com

            console.dir(audio);

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
                audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 +
                    '%';
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
        });

        // CKEDITOR.replace('editor1');
        // CKEDITOR.add,

        //     CKEDITOR.replace('editor5');
        // CKEDITOR.add,

        //     CKEDITOR.replace('editor3');
        // CKEDITOR.add,

        //     CKEDITOR.replace('editor8');
        // CKEDITOR.add,

        //     CKEDITOR.replace('editor6');
        // CKEDITOR.add,

        //     CKEDITOR.replace('editor7');
        // CKEDITOR.add,

        //     CKEDITOR.replace('editor9');
        // CKEDITOR.add
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.19/css/froala_editor.pkgd.min.css" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.19/js/froala_editor.pkgd.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/froala_editor.css') }}">
<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/froala_style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/plugins/colors.css') }}">
<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/plugins/emoticons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/plugins/image_manager.css') }}">
<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/plugins/image.css') }}">
<link rel="stylesheet" href="{{ asset('assets/froalaeditor/css/plugins/video.css') }}">

{{-- <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> --}}

{{-- <script type="text/javascript" src="{{ asset('assets/froalaeditor/js/froala_editor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/align.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/colors.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/draggable.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/emoticons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/font_size.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/font_family.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/image.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/image_manager.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/lists.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/video.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/froalaeditor/js/plugins/fullscreen.min.js') }}"></script> --}}
<script type="text/javascript">
    const froala_editor_key = '{{ config('app.froala_editor_key') }}';
</script>

<script>
    $(document).ready(function() {
            
        $('#thumbnail_image').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
            $('.course_module_thumbnail_image_preview').attr('src', e.target.result);
            $(".course_module_thumbnail_image_preview").removeClass('d-none');
            $(".course_module_thumbnail_image_preview").addClass('d-block');
            }
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
        });
                
        $('#audio_recording').change(function() {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
            playAudio(e.target.result);
            $(".audioWaliDiv").removeClass('d-none');
            $(".audioWaliDiv").addClass('d-block');
            }
            // Read the file as a data URL
            reader.readAsDataURL(file);
        }
        });
            
//     $('#closure_video').on('change', function () {
//     var fileInput = $(this)[0];

//     if (fileInput.files && fileInput.files[0]) {
//         var fileName = fileInput.files[0].name;
//         var fileExtension = fileName.split('.').pop().toLowerCase();

//         // Check if the file extension is one of the allowed video extensions
//         if (['mp4', 'avi', 'mov', 'webm'].includes(fileExtension)) {
//             var reader = new FileReader();

//             reader.onload = function (e) {
//                 var thumbnailUrl = e.target.result;

//                 console.log(thumbnailUrl);

//                 // Display the thumbnail
//                 $("#video_thumbnailURL").attr('src', thumbnailUrl);
//                 $(".video_thumbnailContainer").removeClass('d-none');
//                 $(".video_thumbnailContainer").addClass('d-block');
//             };

//             reader.readAsDataURL(fileInput.files[0]);
//         } else {
            
//             // $("#video_thumbnailContainer").removeClass('d-block');
//             $(".video_thumbnailContainer").addClass('d-none');
                    
//             // Display an error message or handle the invalid file extension case
//             var message = 'Invalid file type. Please select a valid video file (e.g., mp4, avi, mov, webm).';                        
//             Swal.fire({
//                 toast: true,
//                 icon: 'warning',
//                 title: message ,
//                 position: 'top-right',
//                 showConfirmButton: false,
//                 timer: 2000,
//                 timerProgressBar: true,
//                 // footer: '<a href="">Click to open</a>',
//                 didOpen: (toast) => {
//                 toast.addEventListener('mouseenter', Swal.stopTimer)
//                 toast.addEventListener('mouseleave', Swal.resumeTimer)
//                 }
//             });
                    
//             $(this).val(''); // Clear the file input
//         }
//     }
// });

$(".removethumbnailAudio").click(function(){
    $("#audio_recording").val(''); // Clear    
    
    $("#audioRecording").html('<input type="hidden" name="audio_recording_tmp" id="audio_recording_tmp" value="removed">');
    $(".audioWaliDiv").removeClass('d-block');
    $(".audioWaliDiv").addClass('d-none'); 
});

// $(".removethumbnailVideo").click(function(){
//     $("#closure_video").val(''); // Clear
//     $("#video_thumbnailURL").attr('src', '');
//     $(".video_thumbnailContainer").removeClass('d-block');
//     $(".video_thumbnailContainer").addClass('d-none'); 
// });



        
            var postEditor = new FroalaEditor('#introduction', {
                key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Introduction...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                imageUploadURL: "{{ route('upload.image') }}",
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],

                videoUpload: true,
                videoUploadURL: "{{ route('upload.video') }}",
                // videoAllowedTypes: ['mp4', 'avi', 'mpeg', 'quicktime'],
                videoManagerLoadURL: '/load-videos',
                videoManagerDeleteURL: '/delete-video',
                videoDefaultDisplay: 'flex',
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerPreloader: '/preloader.gif',

                videoManagerPageSize: 12,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign',
                    'videoSize'
                ],
                videoUploadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerLoadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerDeleteParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerSelection: true,
                videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku'],
                videoResponsive: true,
                charCounterCount: false,
                videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25'],
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoUploadMethod: 'POST',
                videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4', 'MOV'],
                videoManagerSortBy: 'name',
                videoManagerSortOrder: 'ASC',
                videoManagerView: 'grid',
                videoManagerGridPerPage: 12,
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                videoManagerListView: {
                    listType: 'ul',
                    listClass: 'fr-video-list',
                    itemClass: 'fr-video-item'
                },
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });

            var postEditor = new FroalaEditor('#video_lesson', {
                key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Video Lesson...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                imageUploadURL: "{{ route('upload.image') }}",
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],

                videoUpload: true,
                videoUploadURL: "{{ route('upload.video') }}",
                // videoAllowedTypes: ['mp4', 'avi', 'mpeg', 'quicktime'],
                videoManagerLoadURL: '/load-videos',
                videoManagerDeleteURL: '/delete-video',
                videoDefaultDisplay: 'flex',
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerPreloader: '/preloader.gif',

                videoManagerPageSize: 12,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign',
                    'videoSize'
                ],
                videoUploadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerLoadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerDeleteParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerSelection: true,
                videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku'],
                videoResponsive: true,
                charCounterCount: false,
                videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25'],
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoUploadMethod: 'POST',
                videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4', 'MOV'],
                videoManagerSortBy: 'name',
                videoManagerSortOrder: 'ASC',
                videoManagerView: 'grid',
                videoManagerGridPerPage: 12,
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                videoManagerListView: {
                    listType: 'ul',
                    listClass: 'fr-video-list',
                    itemClass: 'fr-video-item'
                },
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
                }
            });
            
            
            var audio_recording_description = new FroalaEditor('#audio_recording_description', {
                key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Audio Lesson...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                imageUploadURL: "{{ route('upload.image') }}",
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],

                videoUpload: true,
                videoUploadURL: "{{ route('upload.video') }}",
                // videoAllowedTypes: ['mp4', 'avi', 'mpeg', 'quicktime'],
                videoManagerLoadURL: '/load-videos',
                videoManagerDeleteURL: '/delete-video',
                videoDefaultDisplay: 'flex',
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerPreloader: '/preloader.gif',

                videoManagerPageSize: 12,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign',
                    'videoSize'
                ],
                videoUploadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerLoadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerDeleteParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerSelection: true,
                videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku'],
                videoResponsive: true,
                charCounterCount: false,
                videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25'],
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoUploadMethod: 'POST',
                videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4', 'MOV'],
                videoManagerSortBy: 'name',
                videoManagerSortOrder: 'ASC',
                videoManagerView: 'grid',
                videoManagerGridPerPage: 12,
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                videoManagerListView: {
                    listType: 'ul',
                    listClass: 'fr-video-list',
                    itemClass: 'fr-video-item'
                },
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });
            
            const Task = new FroalaEditor('#task', {
              key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Task...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                videoUpload: true,
                videoResponsive: true,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                imageUploadURL: "{{ route('upload.image') }}",
                videoUploadURL: "{{ route('upload.video') }}",
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                imageInsertButtons: ['imageUpload'],
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });

            var postEditor = new FroalaEditor('#quiz_description', {
                key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Quiz Description...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    // 'insertImage',
                    // 'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                imageUploadURL: "{{ route('upload.image') }}",
                imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],

                videoUpload: true,
                videoUploadURL: "{{ route('upload.video') }}",
                // videoAllowedTypes: ['mp4', 'avi', 'mpeg', 'quicktime'],
                videoManagerLoadURL: '/load-videos',
                videoManagerDeleteURL: '/delete-video',
                videoDefaultDisplay: 'flex',
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerPreloader: '/preloader.gif',

                videoManagerPageSize: 12,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign',
                    'videoSize'
                ],
                videoUploadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerLoadParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerDeleteParams: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                videoManagerSelection: true,
                videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku'],
                videoResponsive: true,
                charCounterCount: false,
                videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25'],
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoUploadMethod: 'POST',
                videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4', 'MOV'],
                videoManagerSortBy: 'name',
                videoManagerSortOrder: 'ASC',
                videoManagerView: 'grid',
                videoManagerGridPerPage: 12,
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                videoManagerListView: {
                    listType: 'ul',
                    listClass: 'fr-video-list',
                    itemClass: 'fr-video-item'
                },
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });

            const reflection_questions = new FroalaEditor('#reflection_questions', {
              key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Reflection Questions...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                videoUpload: true,
                videoResponsive: true,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                imageUploadURL: "{{ route('upload.image') }}",
                videoUploadURL: "{{ route('upload.video') }}",
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                imageInsertButtons: ['imageUpload'],
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });
            const reference_link = new FroalaEditor('#reference_link_description', {
              key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share your Refrence Details...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                videoUpload: true,
                videoResponsive: true,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                imageUploadURL: "{{ route('upload.image') }}",
                videoUploadURL: "{{ route('upload.video') }}",
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                imageInsertButtons: ['imageUpload'],
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video'); // Find the video element within the container
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });
            const closure_video_description = new FroalaEditor('#closure_video_description', {
              key: froala_editor_key,
                attribution: false,
                placeholderText: 'Share Your Video Description...',
                imageInsertButtons: ['imageUpload'],
                toolbarButtons: {
                    moreText: {
                buttons: [
                    'bold',
                    'italic',
                    'underline',
                    'strikeThrough',
                    'subscript',
                    'superscript',
                    'inlineStyle'
                ]
                },
                moreParagraph: {
                    buttons: [
                        'alignLeft',
                        'alignCenter',
                        'alignRight',
                        'alignJustify',
                        'formatOL',
                        'formatUL',
                        'outdent',
                        'indent',
                        'quote',
                        'paragraphStyle'
                    ]
                },
                moreRich: {
                    buttons: [
                    'insertLink',
                    'insertImage',
                    'insertVideo',
                    'insertTable',
                    'emoticons',
                    'specialCharacters',
                    'insertHR',
                    'selectAll',
                    'clearFormatting',
                    'print',
                    'help',
                    'html',
                    'undo',
                    'redo',
                    'trackChanges',
                    'markdown'
                ]
                },

                fontFamily: {
                    buttons: ['fontFamily', 'Arial', 'Verdana', 'Tahoma', 'Times New Roman']
                },
                fontSize: {
                    buttons: ['fontSize', '8', '10', '12', '14', '18', '24']
                }
                },
                videoUpload: true,
                videoResponsive: true,
                videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],
                imageUploadURL: "{{ route('upload.image') }}",
                videoUploadURL: "{{ route('upload.video') }}",
                videoDefaultWidth: '640',
                videoDefaultHeight: '360',
                videoDefaultAlign: 'center',
                videoMaxSize: 500 * 1024 * 1024, // 500MB
                videoManagerGridView: {
                    gridWidth: 'auto',
                    gridMargin: 10
                },
                requestHeaders: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                imageInsertButtons: ['imageUpload'],
                events: {                   
                    'image.inserted': function($img) {
                        console.log('Image inserted:', $img.attr('src'));
                    },
                    'video.inserted': function($video) {
                        if ($video) {
                            var videoElement = $video.find('video');
                            if (videoElement) {
                                videoElement.attr('controls', '');
                                videoElement.attr('controlslist', 'nodownload');
                            }
                        }
                    }
        
                }
            });
        });
</script>
<script>
    var i = {{ $i }}; // Initialize i with the value from PHP
        
        $(document).ready(function() {
            $('.add').on('click', function() {
                i++;
                var link = '<span class="mb-2 d-block" id="personal_link_static' + i + '"><div class="d-flex gap-3">';
                link += '<input class="form-control shadow py-2" type="text" name="reference_title[]" placeholder="Reference Title" value="">';
                link += '<input class="form-control shadow py-2" type="text" name="reference_link[]" placeholder="Reference Links" value="">';
                link += '<span class="lm_form-add flex-shrink-0  shadow ms-0 " onclick="remove_added_reference_link(' + i + ')"><img src="{{ asset('assets/images/trash.svg') }}" alt=""></span>';
                link += '</div></span>';
                $('.append_related_link').append(link);
                console.log(link);
                return false;
            });
    
            $('.remove_added_dynamic').on('click', function() {
                var button_id = $(this).attr("id");
                $('#reference_link_dynamic' + button_id).remove();
                return false;
            });
        });
    
        /* Remove Edit Profile Personal link button */
        function remove_added_reference_link(id = '') {
            var button_id = id;
            $('#personal_link_static' + button_id).remove();
            return false;
        }
</script>

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
@endsection