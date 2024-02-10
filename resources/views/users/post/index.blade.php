@extends('layouts.admin.master')
@section('content')
<link href="{{ asset('assets/emoji/css/emoji.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/network-page.css') }}" >


<section class="lm__dash-con lm__create-post auto-load"><span class="lm_vec"><img class="light"
            src="{{ asset('assets/images/light.png') }}" alt=""><img class="dark"
            src="{{ asset('assets/images/dark.png') }}" alt=""></span>
    <div class="container">
        <div class="row">
            <div class="col col-md-7 col-xxl-6 lm_post-card">
                <div class="wrappers">
        
                    <div class="loader-list">
                            <!-- Loader 4 -->
                            <svg width="150px" height="150px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;">
                            <circle cx="75" cy="50" fill="#e4a32b" r="6.39718">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.875s"></animate>
                            </circle>
                            <circle cx="67.678" cy="67.678" fill="#e4a32b" r="4.8">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.75s"></animate>
                            </circle>
                            <circle cx="50" cy="75" fill="#e4a32b" r="4.8">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.625s"></animate>
                            </circle>
                            <circle cx="32.322" cy="67.678" fill="#e4a32b" r="4.8">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.5s"></animate>
                            </circle>
                            <circle cx="25" cy="50" fill="#e4a32b" r="4.8">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.375s"></animate>
                            </circle>
                            <circle cx="32.322" cy="32.322" fill="#e4a32b" r="4.80282">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.25s"></animate>
                            </circle>
                            <circle cx="50" cy="25" fill="#e4a32b" r="6.40282">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.125s"></animate>
                            </circle>
                            <circle cx="67.678" cy="32.322" fill="#e4a32b" r="7.99718">
                                <animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="0s"></animate>
                            </circle>
                        </svg>
                            
                      
                      </li>
                    </div>
                </div>
                <div class="lm_post-card">

                    <form class="row g-4" style="text-align: left;" id="create_form" method="POST"
                        enctype="multipart/form-data" id="image-upload-form">
                        @csrf
                        <input type="hidden" name="post_type" class="post_type" id="post_type" value="post">
                        <div class="card p-2 border-0">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />

                            <ul class="nav nav-tabs lm_post-tab" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" onclick="update_post_type('post')" id="home-tab"
                                        data-bs-toggle="tab" name="post" value="post" data-bs-target="#post-tab-pane"
                                        type="button" role="tab" aria-controls="post-tab-pane"
                                        aria-selected="true">Post</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" onclick="update_post_type('article')" id="profile-tab"
                                        data-bs-toggle="tab" name="article" value="article"
                                        data-bs-target="#article-tab-pane" type="button" role="tab"
                                        aria-controls="article-tab-pane" aria-selected="false">Article</button>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" onclick="update_post_type('event')" id="contact-tab"
                                        data-bs-toggle="tab" name="event" value="event" data-bs-target="#event-tab-pane"
                                        type="button" role="tab" aria-controls="event-tab-pane"
                                        aria-selected="false">Event</button>
                                </li>
                                --}}

                                <li class="nav-item" role="presentation"><button class="nav-link"
                                        onclick="update_post_type('poll_question')" id="contact-tab"
                                        data-bs-toggle="tab" data-bs-target="#poll-tab-pane" type="button" role="tab"
                                        aria-controls="poll-tab-pane" aria-selected="false">Poll</button></li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="post-tab-pane" role="tabpanel"
                                    aria-labelledby="post-tab" tabindex="0">
                                    <div class="lm_post-input-wrap mt-1 position-relative">

                                        {{-- <input type="hidden" name="media_id" class="media_id" id="media_id"
                                            value="1"> --}}

                                        <textarea class="form-control lm_post-textarea rounded-0" id="post_content"
                                            name="post_content" rows="3"
                                            placeholder="Share your thoughts..."></textarea>
                                        {{-- <div>
                                            <p style="color:red">ashgdjkagjskdgjkasd</p>
                                        </div> --}}

                                        <input type="hidden" name="media-id-input" id="media-id-input" value="">




                                        <span class="help-block content_error" style="color: red;"></span>
                                        {{-- <span class="help-block print-error-msg" style="color: red;">
                                            <ul>
                                                <li></li>
                                            </ul>
                                        </span> --}}
                                        {{-- <div
                                            class="lm_post-input-emoji d-flex gap-3 justify-content-end position-absolute bottom-0 end-0 mb-2 me-3">
                                            --}}
                                            {{-- <span><img class="in-svg" src="{{ asset('assets/images/emoji.svg') }}"
                                                    alt=""></span> --}}
                                            {{-- <span type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasRight13" aria-controls="offcanvasRight13"><img
                                                    class="in-svg" src="{{ asset('assets/images/image.svg') }}"
                                                    alt=""></span> --}}
                                            {{-- <span><img class="in-svg" src="{{ asset('assets/images/link-1.svg') }}"
                                                    alt=""></span> --}}
                                            {{-- </div> --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="article-tab-pane" role="tabpanel"
                                    aria-labelledby="article-tab" tabindex="0">
                                    <div class="lm_post-input-wrap mt-1 position-relative">



                                        <textarea class="form-control lm_post-textarea rounded-0" id="article_content"
                                            name="RichTextEditor" rows="3"
                                            placeholder="Share your thoughts..."></textarea>

                                        {{--
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/froala_editor.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/froala_style.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/code_view.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/colors.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/emoticons.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/image_manager.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/image.css')}}"> --}}


                                        {{--
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/line_breaker.css')}}"> --}}
                                        {{--
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/table.css')}}"> --}}
                                        {{--
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/char_counter.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/video.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/fullscreen.css')}}">
                                        <link rel="stylesheet"
                                            href="{{asset('assets/froalaeditor/css/plugins/file.css')}}">
                                        <link rel="stylesheet"
                                            href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">
                                        --}}




                                        <script>
                                            $(document).ready(function() {
                      ////// Start Editor for Normal Post
                        var postEditor = new FroalaEditor('#post_content', {
                            key: froala_editor_key,
                            attribution: false,
                            placeholderText: 'Share your thoughts...',
                            imageInsertButtons: ['imageUpload'],
                            toolbarButtons: {
                                // Specify the toolbar buttons you want to keep
                                moreText: {
                                buttons: ['bold', 'italic', 'underline']
                                },
                                moreParagraph: {
                                buttons: ['alignLeft', 'alignCenter', 'formatOLSimple']
                                },
                                moreRich: {
                                buttons: ['insertImage','insertVideo', 'emoticons', 'fontAwesome', 'specialCharacters']
                                }
                            },
                            imageUploadURL: "{{ route('upload.image') }}",
                            imageAllowedTypes: ['jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP', 'tiff', 'TIFF', 'ico', 'ICO', 'svg', 'SVG', 'HEIC'],
                            imageMaxSize: 50 * 1024 * 1024,
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
                            
                            videoManagerPageSize: 12
                            , videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager']
                            , videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign', 'videoSize']
                            , videoUploadParams: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerLoadParams: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerDeleteParams: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerSelection: true
                            , videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku']
                            , videoResponsive: true
                            ,charCounterCount: false
                            , videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25']
                            , videoDefaultWidth: '640'
                            , videoDefaultHeight: '360'
                            , videoDefaultAlign: 'center'
                            , videoMaxSize: 200 * 1024 * 1024
                            , videoUploadMethod: 'POST'
                            ,videoAllowedTypes: ['avi', 'AVI', 'webm', 'mov', 'HEVC', 'flv', 'FLV', 'mp4','MOV','WMV', 'AVCHD', 'F4V', 'SWF', 'MKV', 'WEBM']
                            , videoManagerSortBy: 'name'
                            , videoManagerSortOrder: 'ASC'
                            , videoManagerView: 'grid'
                            , videoManagerGridPerPage: 12
                            , videoManagerGridView: {
                                gridWidth: 'auto'
                                , gridMargin: 10
                            }
                            , videoManagerListView: {
                                listType: 'ul'
                                , listClass: 'fr-video-list'
                                , itemClass: 'fr-video-item'
                            },
                            events: {
                            'image.inserted': function($img) {
                                console.log('Image inserted:', $img.attr('src'));
                                $('#user_post_btn').prop('disabled', false);
                            },
                            'video.inserted': function($video) {
                                console.log('Video inserted:', $video.attr('src'));
                                $('#user_post_btn').prop('disabled', false);
                            },
                            'contentChanged': function () {
                                checkEditorContent();
                            },
                                                        
                            // 'image.inserted': function($img, response) {
                            //     $('#insertImage-1').hide();
                            //     $('#insertVideo-1').hide();

                            // }
                            // , 'image.removed': function($img) {
                            //     $('#insertImage-1').show();
                            //     $('#insertVideo-1').show();
                            // }
                            // , 'video.inserted': function($img, response) {
                            //     $('#insertImage-1').hide();
                            //     $('#insertVideo-1').hide();

                            // }
                            // , 'video.removed': function($img) {
                            //     $('#insertImage-1').show();
                            //     $('#insertVideo-1').show();
                            // }
                
                
                            }
                        });
                        function checkEditorContent()
                        {
                            let editor = new FroalaEditor('#post_content', {}, function() {});
                            
                            // Get the content from the Froala Editor
                            let contentPost = editor.html.get();
                            content = contentPost;
                            let textContent = $(contentPost).text();
                            // Remove leading and trailing whitespace (including line breaks)
                            textContent = textContent.trim();
                            if (textContent !== '') {
                                // Froala Editor has content, enable the button
                                $('#user_post_btn').prop('disabled', false);
                            } else {
                                // Froala Editor is empty, disable the button
                                $('#user_post_btn').prop('disabled', true);
                            }
                            ////// Start Editor for Article post
                        }

                        const editor = new FroalaEditor('#article_content', {
                            key: froala_editor_key,
                            attribution: false
                            ,placeholderText: 'Share your thoughts...'
                            ,imageInsertButtons: ['imageUpload']
                            ,toolbarButtons: {
                            // Specify the toolbar buttons you want to keep
                            moreText: {
                            buttons: ['bold', 'italic', 'underline']
                            },
                            moreParagraph: {
                            buttons: ['alignLeft', 'alignCenter', 'formatOLSimple']
                            },
                            moreRich: {
                            buttons: ['insertImage','insertVideo', 'emoticons', 'fontAwesome', 'specialCharacters']
                            }
                        }
                            , videoUpload: true
                            , videoUploadURL: "{{ url('/upload-video') }}"
                            , videoAllowedTypes: ['mp4', 'avi', 'mpeg', 'quicktime']
                            , videoManagerLoadURL: '/load-videos'
                            , videoManagerDeleteURL: '/delete-video'
                            , videoDefaultDisplay: 'flex'
                            , imageDefaultAlign: 'center'
                            , requestHeaders: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerPreloader: '/preloader.gif'
                            , videoManagerPageSize: 12
                            , videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager']
                            , videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign', 'videoSize']
                            , videoUploadParams: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerLoadParams: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerDeleteParams: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            }
                            , videoManagerSelection: true
                            , videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku']
                            , videoResponsive: true
                            ,charCounterCount: false
                            , videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25']
                            , videoDefaultWidth: '640'
                            , videoDefaultHeight: '360'
                            , videoDefaultAlign: 'center'
                            , videoMaxSize: 1024 * 1024 * 200
                            , videoUploadMethod: 'POST'
                            , videoManagerSortBy: 'name'
                            , videoManagerSortOrder: 'ASC'
                            , videoManagerView: 'grid'
                            , videoManagerGridPerPage: 12
                            , videoManagerGridView: {
                                gridWidth: 'auto'
                                , gridMargin: 10
                            }
                            , videoManagerListView: {
                                listType: 'ul'
                                , listClass: 'fr-video-list'
                                , itemClass: 'fr-video-item'
                            }
                            , events: {
                                'image.beforeUpload': function(files) {
                                    const editor = this
                                    if (files.length) {
                                        var reader = new FileReader()
                                        reader.onload = function(e) {
                                            var result = e.target.result
                                            editor.image.insert(result, null, null, editor.image.get())
                                        }
                                        reader.readAsDataURL(files[0])
                                    }
                                    return false
                                }
                            }
                        })
                    });

                                        </script>
                                        <span class="help-block content_error" style="color: red;"></span>
                                        {{-- <span class="help-block print-error-msg" style="color: red;">
                                            <ul>
                                                <li></li>
                                            </ul>
                                        </span> --}}
                                        <div
                                            class="lm_post-input-emoji d-flex gap-3 justify-content-end position-absolute bottom-0 end-0 mb-2 me-3">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="event-tab-pane" role="tabpanel"
                                    aria-labelledby="event-tab" tabindex="0">
                                    <div class="lm_post-input-wrap mt-1 position-relative">
                                        <textarea class="form-control lm_post-textarea rounded-0"
                                            id="exampleFormControlTextarea3" rows="3"
                                            placeholder="Share your thoughts..."></textarea>
                                        <div class="lm_post-input-emoji d-flex gap-3 justify-content-end position-absolute bottom-0 end-0 mb-2 me-3">
                                            <span> <img class="in-svg" src="{{ asset('assets/images/emoji.svg') }}" alt=""></span>
                                            <span><img class="in-svg" src="{{ asset('assets/images/image.svg') }}" alt=""></span>
                                            <span><img class="in-svg" src="{{ asset('assets/images/link-1.svg') }}" alt=""></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="poll-tab-pane" role="tabpanel" aria-labelledby="poll-tab"
                                    tabindex="0">
                                    <div class="lm_post-input-wrap mt-1 position-relative">
                                        <textarea class="form-control lm_post-textarea rounded-0 mb-2"
                                            name="poll_content" id="poll_ques" style="resize: none;" rows="2"
                                            placeholder="What would you like to ask ?"></textarea>
                                        <div
                                            class="lm_post-input-emoji position-absolute bottom-0 end-0 mb-2 me-3 w-100 me-auto text-end d-flex justify-content-end align-items-center px-3 post-text">
                                            {{-- <select class="form-select form-control js-example-basic-single"
                                                id="select_box" name="poll_type">
                                                <option value="poll_question">Question</option>
                                                <option value="poll_multiple_choice">Multiple Choice</option>
                                                <option value="poll_percentage">Percentage</option>
                                            </select> --}}

                                            {{-- <div class="lm__term mb-3">
                                                <label class="lm-check-term ps-4 mb-0 lh-1 text-dark">Allow selecting
                                                    mulitiple option
                                                    <input type="checkbox" name="reportPostReason" value=""><span
                                                        class="checkmark"></span>
                                                </label>
                                            </div> --}}
                                            <select class="form-select form-control js-example-basic-single"
                                                id="select_box">
                                                <option value="poll_question">Question</option>
                                                <option value="poll_multiple_choice">Multiple Choice</option>
                                                <option value="poll_percentage">Percentage</option>
                                            </select>


                                        </div>
                                    </div>


                                    <span class="print-error-msg" style="color: red;">
                                        <ul>
                                            <li></li>
                                        </ul>
                                    </span>
                                    <div class="multi_choice_hide mx-3 mt-2" id="a">

                                        <div class="d-flex mb-3">
                                            <input class="form-control shadow py-2" name="add_choice[]" type="text"
                                                placeholder="Add a choice">
                                            <span class="lm_form-add shadow ms-3 add_poll_choice_btn"><img
                                                    src="{{ asset('assets/images/plus2.svg') }}" alt=""></span>
                                        </div>
                                        <div class="poll_choice_append">
                                            <!-- Existing input fields can be added here -->
                                        </div>
                                    </div>


                                    {{-- <div class="multi_choice_hide mx-3 mt-2" id="a">
                                        <div class="poll_choice_append"></div>
                                        <div class="d-flex mb-3">
                                            <input class="form-control shadow py-2" name="add_choice[]" type="text"
                                                placeholder="Add a choice">
                                            <span class="lm_form-add shadow ms-3 add_poll_choice_btn"><img
                                                    src="{{ asset('assets/images/plus2.svg') }}" alt=""></span>
                                        </div>
                                    </div> --}}
                                    <div class="lm__form-input mx-3 mt-2 poll_expiration_hide">
                                        <div class="d-flex mb-3 align-items-center gap-2"><label
                                                class="form-label me-2 mb-0 title-font">Expiration</label>
                                            <div class="form-control-icon position-relative">
                                                {{-- <input id="datetimepicker" type="text"> --}}

                                                @php
                                                //$userDate = date('Y-m-d H:i');

                                                // echo convertUtcToUserTimezone($userDate,getUserTimeZone());
                                                // $userTimezone = getUserTimeZone();

                                                // echo getDateTimeFormat($userDate);

                                                // $userTimezone = getUserTimeZone();
                                                // $utcDate = convertToUtc($userDate, getUserTimeZone());
                                                // echo $utcDate;
                                                @endphp

                                                {{-- <input class="form-control icon shadow py-3" type="datetime-local"
                                                    name="poll_expiration_temp" id="poll_expiration_temp"
                                                    onchange="formatDate('poll_expiration_temp')"
                                                    value="{{ date('Y-m-d H:i:s') }}"> --}}
                                                <input class="form-control icon shadow py-3" type="text"
                                                    name="poll_expiration" id="poll_expiration"
                                                    value="{{ getDateTimeFormat(date('Y-m-d H:i')) }}">
                                            </div>
                                        </div>

                                        {{-- <span class="print-error-msg" style="color: red;">
                                            <ul>
                                                <li></li>
                                            </ul>
                                        </span> --}}
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="lm_post-input-emoji lm_post-button hstack my-3 justify-content-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <button class="btn btn--replay py-1 title-font btn_save_post"
                                    id="user_post_btn">Post</button>
                                <div class="lm__cal"><a type="button" data-bs-toggle="modal"
                                        data-bs-target="#post_schedule">
                                        <span><img class="in-svg" src="{{ asset('assets/images/calander.svg') }}"
                                                alt=""></span></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- <div class="ajax-load text-center" style="display:none">
                    <p><img src="{{ asset('assets/images/loader.gif') }}">Loading More post</p>
                </div> --}}

                <!-- Start Featured  post -->
                <div class="lm-featured-post">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span><img class="in-svg" src="{{ asset('assets/images/featuredpost.svg')}}" alt=""></span>
                        <h4 class="mb-0">Featured Posts</h4>
                        <div class="d-block">
                            <div class="swiper-button-next lm-featured-next">
                                <img class="in-svg" src="{{ asset('assets/images/sw-left.svg') }}" alt="">
                            </div>
                            <div class="swiper-button-prev lm-featured-prev">
                                <img class="in-svg" src="{{ asset('assets/images/sw-right.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="swiper mySwiper-post">
                        <div class="swiper-wrapper featuredPost featuredPost-video">
                        </div>
                    </div>
                </div>
                <!-- End Featured  post -->
                <div class="lm_post-card lm_card-post my-4 auto-load" id="post-data">
                    @include('users.post.post_xhr')
                </div>


            </div>
            <div class="col col-md-5 col-xxl-4 mb-4 auto-load" id="right-section">
                @include('users.post.right_panel')
            </div>

        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="lm__term--title">
                    <h3 class="mb-2">Accept our terms of service</h3>
                    <p class="mb-2">To continue, please accept our Terms of Service</p>
                </div>
                <div class="lm__term">
                    <label class="lm-check-term">I agree to the Terms of Service and Privacy Policy (required)
                        <input type="checkbox" checked="checked"><span class="checkmark"> </span>
                    </label>
                    <label class="lm-check-term">I agree to receive activity emails from this Mighty Network. I can
                        refine or revoke this consent anytime. (opt-in)
                        <input type="checkbox" checked="checked"><span class="checkmark"> </span>
                    </label>
                    <label class="lm-check-term">I agree to receive activity emails from this Mighty Network. I can
                        refine or revoke this consent anytime. (opt-in)
                        <input type="checkbox" checked="checked"><span class="checkmark"> </span>
                    </label>
                    <label class="lm-check-term">I agree to receive commercial emails from this Mighty Network. I can
                        revoke this consent at any time by unsubscribing to any commercial email from this Host.
                        (opt-in)
                        <input type="checkbox" checked="checked"><span class="checkmark"></span>
                    </label>
                    <div class="lm__term--button">
                        <button class="btn btn--primary">Confirm</button>
                        <button class="close-button" type="button" data-bs-dismiss="modal">Cancle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-2">
        <div class="modal-content">
            <div class="modal-body p-4 text-center">
                <div class="lm__term--title">
                    <h3 class="mb-2 fw-bold">Are you sure you want to sign out?</h3>
                </div>
                <div class="lm__term--button">
                    <button class="btn btn--primary">Yes, Sign Out</button>
                    <button class="close-button" type="button" data-bs-dismiss="modal">Cancle</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-2">
        <div class="modal-content">
            <div class="modal-body p-4 text-center"><span class="mb-2"><img class="in-svg mx-auto"
                        src="{{ asset('assets/images/CheckCircle.svg') }}" alt=""></span>
                <div class="lm__term--title">
                    <h3 class="my-2 fw-bold">Success!</h3>
                    <p class="text-light mb-2">Lorem ipsum dolor sit amet consectetur. Feugiat nibh proin orci mattis
                        proin massa platea adipiscing odio</p>
                </div>
                <div class="lm__term--button mt-3">
                    <button class="btn btn--primary me-0">Go to Dashboard</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-3">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="lm__shape-1 position-absolute top-0 start-0"><img class="in-svg"
                        src="{{ asset('assets/images/shape1.svg') }}" alt=""></div>
                <div class="lm__shape-2 position-absolute bottom-0 end-0"><img class="in-svg"
                        src="{{ asset('assets/images/shape33.svg') }}" alt=""></div>
                <div class="lm__shape-3"> <img class="in-svg" src="{{ asset('assets/images/logoshape1.png') }}" alt="">
                </div>
                <div class="lm__modal-body">
                    <div class="lm__modal-3-con position-relative z-index-3">
                        <h2 class="text-white">Welcome to our Ambassador Launch4</h2>
                    </div>
                    <div class="lm__modal-3-video position-relative z-index-3 mb-3">
                        <iframe width="750" height="425" src="https://www.youtube.com/embed/DFSK_sVwOY8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen=""></iframe>
                    </div>
                    <div class="lm__modal-3-con position-relative z-index-3">
                        <p class="text-white">As a valued friend of PEEQ, we are thrilled to have you in our Global
                            Leadership Network. Alongside a select circle of leaders, hand-picked by Zoe, we are excited
                            to welcome you into this brand-new, exclusive Network. You are part of a group of CEOs,
                            Executives, Team Leaders and Business Owners who we have chosen to connect within the PEEQ
                            experience first. The reason we have chosen you is that you have already shown interest in
                            learning more from Zoe and the PEEQ team and we wanted to find a way to give you access to
                            this without having to rely on scheduled calls, meetings or even in-person appointments.</p>
                    </div>
                    <div class="lm__modal-btn">
                        <button class="btn btn--primary px-5" data-bs-dismiss="modal">Continue4</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Delete Post</h4>
                    <h6 class="text-white">Are you sure you want to delete this post?</h6>
                    <input type="hidden" id="delet_post_id">
                    <button type="submit" class="btn btn--primary mt-3" onclick="delete_post()"
                        value="yes">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" value="no" type="button"
                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Hide Post</h4>
                    <h6 class="text-white">You will no longer see any posts belonging to this Space in your global feed.
                        At anytime you can choose to start seeing the Space posts again.?</h6>
                    <button class="btn btn--primary mt-3">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="blockMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Block Member</h4>
                    <h6 class="text-white">You will no longer receive notifications or private messages from this
                        member. You also won’t see their posts in your Activity Feed.</h6>
                    <button class="btn btn--primary mt-3" onclick="OpenConfirmModalFinal()">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reportPostMemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Report This Member</h4>
                    <div class="d-flex justify-content-center">
                        <ul class="text-start">
                            <li class="px-3">
                                <div class="lm__term mb-3">
                                    <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're posting spam
                                        <input type="checkbox" name="is_report_member"
                                            value="They're posting spam"><span class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="px-3">
                                <div class="lm__term mb-3">
                                    <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're being offensive
                                        <input type="checkbox" name="is_report_member"
                                            value="They're being offensive"><span class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                            <li class="px-3">
                                <div class="lm__term mb-3">
                                    <label class="lm-check-term ps-4 mb-0 lh-1 text-white">They're pretending to be
                                        someone else
                                        <input type="checkbox" name="is_report_member"
                                            value="They're pretending to be someone else"><span
                                            class="checkmark"></span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <button class="btn btn--primary mt-3" onclick="OpenConfirmModalFinal('member')">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal9" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Mute Post</h4>
                    <h6 class="text-white">Are you sure you want to mute this post?.</h6>
                    <button class="btn btn--primary mt-3 confirm_mute_post"
                        onclick="OpenConfirmModalFinal()">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unmutePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Unmute Post</h4>
                    <h6 class="text-white">Are you sure you want to Unmute this post?.</h6>
                    <button class="btn btn--primary mt-3 confirm_mute_post"
                        onclick="OpenConfirmModalFinal()">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hidePostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Hide post from Feed</h4>
                    <h6 class="text-white">Are you sure you want to hide this post from active feed?.</h6>
                    <button class="btn btn--primary mt-3 confirm_mute_post"
                        onclick="OpenConfirmModalFinal()">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="d-flex justify-content-center lm_mxw50">
                    <div class="z-index-1 position-relative">
                        <h4 class="text-start text-white">Report This Post</h4>
                        <div class="d-flex justify-content-start">
                            <ul class="text-start">
                                <li>
                                    <div class="lm__term mb-3">
                                        <label class="lm-check-term ps-4 mb-0 lh-1 text-white">It’s Spam
                                            <input type="checkbox" name="reportPostReason" value="It’s Spam"><span
                                                class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="lm__term mb-3">
                                        <label class="lm-check-term ps-4 mb-0 lh-1 text-white">It’s Offensive
                                            <input type="checkbox" name="reportPostReason" value="It’s Offensive"><span
                                                class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="lm__term mb-3">
                                        <label class="lm-check-term ps-4 mb-0 lh-1 text-white">A different Reason
                                            <input type="checkbox" name="reportPostReason"
                                                value="A different Reason"><span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="lm_report d-flex justify-content-start">
                            <div class="d-block my-3">
                                <textarea class="form-control" name="reportPostDescription" id="reportPostDescription"
                                    rows="2" placeholder="Add Description"></textarea>
                            </div>
                        </div>
                        <button class="btn btn--primary mt-3" id="reportPost"
                            onclick="OpenConfirmModalFinal('post')">Confirm</button>
                        <button class="btn-close text-white d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="post_schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-6">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="d-flex justify-content-center lm_mxw50">
                    <div class="z-index-1 position-relative">
                        <h4 class="text-start text-dark text-center fw-bold">Post Schedule Settings</h4>
                    </div>
                </div>
                <div class="lm_mxw50">
                    <div class="d-block lm__form-input radio">
                        <div class="radio-wrap">
                            <div class="form-check d-flex gap-2"><input class="form-check-input" id="schedule_type1"
                                    type="radio" value="post_now" name="schedule_type" checked="checked"><label
                                    class="form-check-label d-block" for="schedule_type1">
                                    <div class="d-block text-start">
                                        <h6 class="mb-1">Post Now</h6>
                                        <p class="mb-2 text-secondary title-font">Post immediately after the "Post"
                                            button
                                            is clicked.</p>
                                    </div>
                                </label>
                            </div>
                            <div class="form-check d-block">
                                <input class="form-check-input" id="schedule_type2" type="radio" name="schedule_type"
                                    value="schedule_post"><label class="form-check-label d-block" for="schedule_type2">
                                    <div class="d-block text-start">
                                        <h6 class="mb-1">Schedule Post</h6>
                                        <p class="mb-2 text-secondary title-font">Post will display on given schedule
                                            date after the "Post" button
                                            is clicked.</p>
                                    </div>
                                </label>
                            </div>
                            <div class="lm__form-input schedule_datetime_div" style="display: none">
                                <div class="d-flex mb-3 align-items-center gap-3"><label
                                        class="form-label me-3 mb-0 title-font">Date & Time</label>
                                    <div class="form-control-icon position-relative">

                                        {{-- value="{{ date('d-M-Y H:i') }}" --}}
                                        {{-- value="{{ getDateTimeFormat(date('Y-m-d H:i')) }}" --}}
                                        {{-- <input type="datetime-local" name="schedule_datetime_temp"
                                            class="form-control icon shadow py-3" id="schedule_datetime_temp"
                                            onchange="formatDate('schedule_datetime_temp')"> --}}
                                        <input type="text" name="schedule_datetime"
                                            class="form-control icon shadow py-3" id="schedule_datetime"
                                            value="{{ getDateTimeFormat(date('Y-m-d H:i')) }}">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-5">
                                <h6>Timezone</h6>
                                <h6>{{ getUserTimeZone();}}</h6>
                                {{-- <h6>{{ Auth::user()->timezone->timezone ?? 'Coordinated Universal Time'}}</h6> --}}
                            </div>
                            <span class="help-block print-error-msg mt-3" style="color: red;">
                                <ul>
                                    <li></li>
                                </ul>
                            </span><br>
                        </div>
                    </div>


                    <button class="btn btn--primary mt-2 btn_save_post">Save Setting</button>
                    <button class="btn-close d-block w-100 mt-2" type="button" data-bs-dismiss="modal"
                        aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal13" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-5">
        <div class="modal-content">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                                alt=""></span></button> </div>
                <div class="d-flex justify-content-center lm_mxw50">
                    <div class="z-index-1 position-relative">
                        <h4 class="text-start text-dark text-center">Comment</h4>
                    </div>
                </div>

                <div class="commentsReplyData">

                </div>
                <input type="hidden" id="post_cmt_id" name="post_cmt_id">
                {{-- <div class="post_comment-reply d-flex gap-2 mt-4">
                    <div class="avtar p-0"><img class="rounded-circle"
                            src="{{ (Auth::user()->profile_image_url) ?? asset('assets/images/logo2.svg') }}" alt="">
                    </div>
                    <div class="post_comment-wrap position-relative w-100 emoji-picker">

                        <input data-emojiable="true"
                            class="form-control border border-dark-subtle rounded-2 p-2 post_cmtt yourComment"
                            name="yourThoughts" type="text" placeholder="Share your thoughts...">

                        <span class="position-absolute top-50 end-0 translate-middle-y me-2 emoji-icon">

                        </span>
                    </div>
                </div>
                <div class="post_cmtt-show post_cmtt-hide post-cmt-reply-show active">
                    <div class="d-flex align-items-center justify-content-end mt-2 gap-2">
                        <button class="btn btn--replay py-1 title-font" onclick="writeComment()">Comment</button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="postDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-5">
        <div class="modal-content">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button></div>
                <div class="d-flex justify-content-center lm_mxw50">
                    {{-- <div class="z-index-1 position-relative"> --}}
                        {{-- <h4 class="text-start text-dark text-center">Post Detail</h4> --}}
                        {{-- </div> --}}
                </div>

                <div class="appendPostdetail">

                </div>

            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight13" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h5 class="text-white mb-0">Media Library</h5>
                </div>
            </div>
        </div>
        <div class="lm_create-body gallary-body">
            <form action="">
                <div class="input-group mb-3"><label class="input-group-text lm__upload-file" for="inputGroupFile01">
                        <div class="d-block"> <span class="d-block upd-title">Upload</span>
                            <div class="d-block"><span class="d-flex justify-content-center"> <img class="in-svg"
                                        src="{{asset('assets/images/file.svg')}}" alt=""></span></div>
                            {{-- <h6 class="d-block">Drag & Drop Media here</h6> --}}
                        </div>
                    </label><input class="form-control" id="inputGroupFile01" type="file"></div>
                <div class="lm__course-tab lm__upd-tab">
                    <div class="d-flex justify-content-between flex-wrap mb-3">
                        <ul class="nav nav-pills mb-3 shadow" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active"
                                    id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery"
                                    type="button" role="tab" aria-controls="pills-gallery"
                                    aria-selected="true">Gallery</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="pills-images-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-images" type="button" role="tab"
                                    aria-controls="pills-images" aria-selected="false">Images</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="pills-videos-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab"
                                    aria-controls="pills-videos" aria-selected="false">Videos</button></li>
                        </ul>
                        <div class="lm__insdtl">
                            <div class="d-flex gap-2"><button class="btn btn--primary py-2">Insert </button><button
                                    class="btn btn--danger py-2">Delete</button></div>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-gallery" role="tabpanel"
                            aria-labelledby="pills-gallery-tab" tabindex="0">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g6.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip1"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g8.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip2"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip2">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g7.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip3"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip3">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g9.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip4"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip4">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip5"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip5">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g1.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip6"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip6">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g2.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip7"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip7">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g4.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip8"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip8">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g3.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip9"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip9">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g5.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip10"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip10">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g11.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip11"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip11">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip12"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip12">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g13.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip13"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip13">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g12.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip14"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip14">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g14.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip15"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip15">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-images" role="tabpanel" aria-labelledby="pills-images-tab"
                            tabindex="0">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g6.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip1"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g14.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip15"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip15">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab"
                            tabindex="0">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="card lm-img-box"><img class="card-img"
                                        src="{{asset('assets/images/g3.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip9"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip9">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" media-id="1"
                                        src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip5"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip5">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" media-id="2"
                                        src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip12"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip12">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Start Post Edit modal --}}
<div class="modal fade" id="PostEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="row g-4" style="text-align: left;">
        @csrf
        <input class="form-control shadow" type="hidden" id="id_edit" name="id" value="">
        <input type="hidden" id="post_type_edit" name="post_type_edit">

        <div class="modal-dialog modal-dialog-centered lm__modal-5">
            <div class="modal-content">
                <div class="modal-body p-4 text-center position-relative">
                    <div class="modal-header p-0">
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                    class="in-svg" src="{{asset('assets/images/close.svg')}}" alt=""></span></button>
                    </div>
                    <div class="z-index-1 position-relative">
                        <div class="d-flex gap-2 align-items-center">
                            <div class="lm_card-post-logo"> <span class="shadow"> <img
                                        class="profile_image editPostProfile"
                                        src="{{ asset('assets/images/user-profile-default.png') }}" alt=""></span></div>
                            <div class="d-lnline text-start">
                                <h5 class="mb-1 editPostFullName"></h5>
                                <p class="mb-0 editPostType"></p>
                            </div>
                        </div>
                        <div class="my-3 position-relative">
                            <form action="#" name="edit_post">

                                <textarea class="form-control lm_post-textarea rounded-0" id="EditPostContent"
                                    name="EditPostContent" rows="6"
                                    placeholder="Which choice best describes where you land in the 'nervous system activated' state?"></textarea>

                                <script>
                                    $(document).ready(function() {
                                        ////// Start Editor for Normal Post
                                        var postEditor = new FroalaEditor('#EditPostContent', {   
                                            key: froala_editor_key,
                                            attribution: false,
                                            charCounterCount: false,
                                            toolbarButtons: {
                          // Specify the toolbar buttons you want to keep
                          moreText: {
                          buttons: ['bold', 'italic', 'underline', 'undo', 'redo']
                          },
                          moreParagraph: {
                          buttons: ['alignLeft', 'alignCenter', 'formatOLSimple']
                          },
                          moreRich: {
                          buttons: ['insertImage','insertVideo','fullscreen']
                          }
                      },
                                            imageInsertButtons: ['imageUpload'],
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
                                            
                                            videoManagerPageSize: 12
, videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager']
, videoEditButtons: ['videoReplace', 'videoRemove', '|', 'videoDisplay', 'videoAlign', 'videoSize']
, videoUploadParams: {
_token: $('meta[name="csrf-token"]').attr('content')
}
, videoManagerLoadParams: {
_token: $('meta[name="csrf-token"]').attr('content')
}
, videoManagerDeleteParams: {
_token: $('meta[name="csrf-token"]').attr('content')
}
, videoManagerSelection: true
, videoAllowedProviders: ['YouTube', 'Vimeo', 'Dailymotion', 'Youku']
, videoResponsive: true
, videoSizeButtons: ['videoSize100', 'videoSize50', 'videoSize25']
, videoDefaultWidth: '640'
, videoDefaultHeight: '360'
, videoDefaultAlign: 'center'
, videoMaxSize: 1024 * 1024 * 200
, videoUploadMethod: 'POST'
, videoManagerSortBy: 'name'
, videoManagerSortOrder: 'ASC'
, videoManagerView: 'grid'
, videoManagerGridPerPage: 12
, videoManagerGridView: {
gridWidth: 'auto'
, gridMargin: 10
}
, videoManagerListView: {
listType: 'ul'
, listClass: 'fr-video-list'
, itemClass: 'fr-video-item'
},
                                            events: {
                                            'image.inserted': function($img) {
                                                console.log('Image inserted:', $img.attr('src'));
                                            },
                                            'video.inserted': function($video) {
                                                console.log('Video inserted:', $video.attr('src'));
                                            }
                                            }
                                        });
                                        
                                    });
                                </script>

                                {{-- <textarea class="form-control" id="content_edit" rows="6"
                                    placeholder="Which choice best describes where you land in the 'nervous system activated' state?"></textarea>
                                --}}
                                {{-- <span class="help-block content_error" style="color: red;"></span> --}}
                                <span class="help-block print-error-msg mt-3" style="color: red;">
                                    <ul>
                                        <li></li>
                                    </ul>
                                </span>
                                {{-- <div
                                    class="lm_post-input-emoji w-100 d-flex gap-3 justify-content-between position-absolute bottom-0 mb-2 me-3 w-100 px-3">
                                    <div class="d-flex gap-3"><span> <img class="in-svg"
                                                src="{{ asset('assets/images/image.svg') }}" alt=""></span><span> <img
                                                class="in-svg" src="{{ asset('assets/images/link-1.svg') }}"
                                                alt=""></span></div><span> <img class="in-svg"
                                            src="{{ asset('assets/images/emoji.svg') }}" alt=""></span>
                                </div> --}}
                            </form>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn--primary mt-3" type="submit" id="btn_update">Update</button>
                            <button class="btn-close text-white close text-dark w-auto" type="button"
                                data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- End Post Edit modal --}}

<div class="modal fade" id="DeletPostCommentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
    <div class="modal-dialog modal-dialog-centered lm__modal-4">
        <div class="modal-content overflow-hidden">
            <div class="modal-body p-4 text-center position-relative">
                <div class="modal-header p-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span> <img
                                class="in-svg" src="{{ asset('assets/images/close.svg') }}" alt=""></span></button>
                </div>
                <div class="lm__modal-4-vec position-absolute top-50 start-50 translate-middle"><img class="in-svg"
                        src="{{ asset('assets/images/logo-3.svg') }}" alt=""></div>
                <div class="z-index-1 position-relative lm_mxw50">
                    <h4 class="text-white">Delete Comment</h4>
                    <h6 class="text-white">Are you sure you want to delete this comment?</h6>
                    <input type="hidden" id="cmt_post_id">
                    <input type="hidden" id="post_comment_id">
                    <input type="hidden" id="deletedFromPopup">
                    <button type="submit" class="btn btn--primary mt-3" onclick="delete_post_comment()"
                        value="yes">Confirm</button>
                    <button class="btn-close text-white d-block w-100 mt-2" value="no" type="button"
                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script> --}}

<script>
    $('input:radio').click(function() {
        $('input:radio[name='+$(this).attr('name')+']').parent().removeClass('checked11');
            $(this).parent().addClass('checked11');

        });
        
</script>
<script>
    function postEditModal(id,post_type='')
    {
        if(id)
        {
            $('#id_edit').val(id);
            $('#post_type_edit').val(post_type);
            var url = "{{route('post.edit', ":id")}}";
            url = url.replace(":id", id);
            $.ajax({
                    url: url
                    , type: "get"
                    , beforeSend: function() {
                        $('.ajax-load').show();
                    }
                })
                .done(function(response) {
                                  
                    const editor = new FroalaEditor('#EditPostContent', { });
                    editor.html.set(response.content);
                    
                    $(".editPostFullName").html(response.user.first_name + " " + response.user.last_name);
                    $(".editPostType").html(response.user.user_type);
                    $(".editPostProfile").attr("src",response.user.profile_image_url);

                    console.log(response);
      
                    $('.ajax-load').hide();

                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
            
            $('#PostEditModal').modal('show');
        }
    }
    $(document).ready(function() {
        //getData();

        $("#btn_update").click(function(e) {
            e.preventDefault();

            $('.content_error').html('');
            $('.article_content_error').html('');
            $('.print-error-msg').html('<ul><li></li></ul>');

            // $("#btn_update").attr("disabled", true);
            let post_type = $("#post_type_edit").val();
            
            // alert(post_type);
            // let post_type = $(this).attr('post_type');
            
            const editorHtmlSource = new FroalaEditor('#EditPostContent', { });
            var message = editorHtmlSource.html.get();

            let _token = $("input[name=_token]").val();
            let media_id = $("#media_id").val();
            let content = message;
            let user_id = $("#user_id").val();

            var id = $('#id_edit').val();
            let url = '{{ route("post.update", ":id") }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url
                , type: "POST"
                , data: {
                    content: content
                    // , user_id: user_id
                    , _token: _token
                    , post_type: post_type
                , }
                , dataType: 'JSON'
                , success: function(data) {
                    $("post_content").val('');
                    $("#btn-update").attr("disabled", false);
                    $("#message").val('');
                    editorHtmlSource.html.set('');

                    $('#PostEditModal').modal('hide');
                    getData();

                    if (data.error) {
                        printErrorMsg(data.error);
                        return false;
                    } else if (data.status == "200") {
                        
                        var success_message = data.message;
                        Swal.fire({
                            toast: true,
                            icon: 'success', //warning ,info
                            title: success_message ,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    }
                    console.log(data);

                }
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    $('.content_error').html(value);
                    $('.article_content_error').html(value);
                });
            }
        });

        $("input[name='schedule_type']").click(function() {
            $(".content_error").html('');
            $('.print-error-msg').html('<ul><li></li></ul>');
            if ($("#schedule_type2").is(":checked")) {
                $(".schedule_datetime_div").show();
            } else {
                // $(".schedule_datetime").val('');
                $(".schedule_datetime_div").hide();
            }
        });



        $(".btn_save_post").click(function(e) {
            e.preventDefault();
            
            
            $('.content_error').html('');
            $('.article_content_error').html('');
            $('.print-error-msg').html('<ul><li></li></ul>');

            let user_id = $("#user_id").val();
            let _token = $("input[name=_token]").val();
            let media_id = $("#media_id").val();

            var content = '';

            let post_type = $("input[name='post_type']").val();

            let poll_type = $('select#select_box').find('option:selected').val();

            var schedule_type = $("input[name='schedule_type']:checked").val();
            var schedule_datetime = '';


            var option = '';

            var dataArray = {
                _token: _token
                , user_id: user_id
                , post_type: post_type
            , };


            var userTimezone = "{{ getUserTimeZone() }}"; 
            
            if (post_type == "post") {
                // content = $("textarea[name='post_content']").val();   
                let editor = new FroalaEditor('#post_content', {}, function() {});
                
                // Get the content from the Froala Editor
                let contentPost = editor.html.get();
                content = contentPost;
                let textContent = $(contentPost).text();
                // Remove leading and trailing whitespace (including line breaks)
                textContent = textContent.trim();
                if (textContent === '') {
                    // Content is empty, display an error message
                    $('#user_post_btn').prop('disabled', true);
                    var success_message = 'Please enter meaningful content in the editor.';                        
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: success_message ,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        // footer: '<a href="">Click to open</a>',
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    return false;
                } else {
                    $('#user_post_btn').prop('disabled', false);
                }

            } else if (post_type == "article") {
                let editor = new FroalaEditor('#article_content', {}, function() {});
                
                // Get the content from the Froala Editor
                let contentPost = editor.html.get();
                content = contentPost;
                let textContent = $(contentPost).text();
                // Remove leading and trailing whitespace (including line breaks)
                textContent = textContent.trim();
                if (textContent === '') {
                    // Content is empty, display an error message
                    
                    var success_message = 'Please enter meaningful content in the editor.';                        
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: success_message ,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        // footer: '<a href="">Click to open</a>',
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    return false;                        
                }

            } else if (post_type == 'poll_question' && poll_type == "poll_question") {
                content = $('textarea[name="poll_content"]').val();
            } else if (post_type == 'poll_multiple_choice' && poll_type == "poll_multiple_choice") {
                var poll_expiration = $("#poll_expiration").val();
                
                var convertedDate = moment.utc(poll_expiration, 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
                
                $('input[name="add_choice[]"]').each(function(index) {
                    if (index > 0) {
                        option += ',';
                    }
                    option += $(this).val();
                });
                if (option != "") {
                    dataArray.option = option;
                }
                dataArray.poll_expiration = convertToUtc(convertedDate, userTimezone);

                content = $('textarea[name="poll_content"]').val();
            } else if (post_type == 'poll_percentage' && poll_type == "poll_percentage") {
                content = $('textarea[name="poll_content"]').val();
                
                var poll_expiration = $("#poll_expiration").val();
                
                dateFormated = moment.utc(poll_expiration, 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
                
                dataArray.poll_expiration = convertToUtc(dateFormated, userTimezone);
            }
            console.log(content);
            
            dataArray.content = content;
                    
            // if (content != "" && content!='<p>&nbsp;</p>' && content!='<p>&nbsp; &nbsp;</p>' && content!='<p>&nbsp; &nbsp;&nbsp;</p>' && content!='<p>&nbsp;&nbsp;</p>' && content!='<p>&nbsp; &nbsp; &nbsp;&nbsp;</p>') {
            //     dataArray.content = content;
            // }
            
            if (schedule_type == 'schedule_post') {
                var schedule_datetime = $("input[name='schedule_datetime']").val();
                
                dateFormated = moment.utc(schedule_datetime, 'DD-MMM-YYYY HH:mm').format('YYYY-MM-DD HH:mm:ss');
                
                converted_schedule_datetime = convertToUtc(dateFormated, userTimezone);
                
                //schedule_datetime = convertToUtc(dateFormated, userTimezone);

                if (schedule_type == "schedule_post") {
                    dataArray.schedule_type = "schedule_post";
                    dataArray.schedule_datetime = converted_schedule_datetime;
                }
                // console.log('schedule date ' + converted_schedule_datetime);
            }
            $(".btn_save_post").attr("disabled", true);
            // console.log('post type= ' + post_type);
            
                                    
        // var currentDate = new Date();
        // var indianDate = formatDate(currentDate);

        //var indianDate = '14-08-2023 15:30:00';
        // var userTimezone = 'Asia/Kolkata'; // Retrieve user's timezone from the database
        // var userDate = convertToUserTimezone(indianDate, userTimezone);
        // console.log('Indian Date:', indianDate);
        // alert('User Date (in user timezone): ' + userDate);

    //   showLoader(); // Show the loader initially
            $.ajax({
                url: "{{route('posts.store')}}"
                , type: "POST"
                , data: dataArray
                , dataType: 'JSON'
                , success: function(data) {
                                  
                    
                    // hideLoader(); // Hide the loader on successful AJAX response
                    // showContent(); // Show the loaded content

                    if (data.error) {
                        $(".btn_save_post").attr("disabled", false);
                        printErrorMsg(data.error);
                        return false;
                    } else if (data.status == "200") {
                                                
                    $(".content_error").html('');
                    $('.print-error-msg').html('<ul><li></li></ul>');

                    $("#post_schedule").modal('hide');

                    $("#post_content").val('');
                    $("#article_content").val('');
                    
                    $("textarea[name=poll_content]").val('');
                    // $("input[name=add_choice]").val('');
                    $('input[name="add_choice[]"]').val('');

                    $(".btn_save_post").attr("disabled", false);
                    $("#message").val('');

                    var editor = FroalaEditor('textarea#post_content');
                    // Clear the editor content
                    editor.html.set('');

                    // Get the textarea element
                    var textarea = document.querySelector('textarea#post_content');
                    // Set the value of the textarea to an empty string
                    textarea.value = '';

                    var editor = FroalaEditor('textarea#article_content');
                    // Clear the editor content
                    editor.html.set('');

                    // Get the textarea element
                    var textarea = document.querySelector('textarea#article_content');
                    // Set the value of the textarea to an empty string
                    textarea.value = '';


                    
                    
                    
                        var success_message = data.message;
                        
                        // Swal.fire({
                        // // icon: 'success!',
                        // title: 'success',
                        // text: success_message,
                        // footer: '<a href="">Why do I have this issue?</a>'
                        // });
                        
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: success_message ,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                        
                        if ((post_type == 'poll_percentage' && poll_type == "poll_percentage") || (post_type == 'poll_question' && poll_type == "poll_question") || (post_type == 'poll_multiple_choice' && poll_type == "poll_multiple_choice"))
                        {
                            location.reload();
                        }
                        else
                        {
                            getData();
                        }
                        
                        
                        // Swal.fire({
                        // // position: 'top-end',
                        // icon: 'success',
                        // title: success_message ,
                        // // text: "<a href=''>Why do I have this issue?</a>",
                        // // footer: '<a href="">Why do I have this issue?</a>'
                        // // showConfirmButton: false,
                        // // timer: 1500
                        // });
                    }

                },
                error: function(xhr, status, error) {
                    $(".btn_save_post").attr("disabled", false);
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                    $('.content_error').text(errorMessage);
                    console.log('errorMessage');
                }
            });

            function printErrorMsg(msg) {

                
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    console.log(value);
                    $('.content_error').text(value);
                });
            }
        });

        ////////// Upload media //////////



        $("#upload_media").change(function(e) {
            e.preventDefault();

            let _token = $("input[name=_token]").val();

            var formData = new FormData();
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            formData.append('name', $('input[name="name"]').attr('content'));

            $.ajax({
                url: "{{route('media')}}"
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , contentType: false
                , processData: false
                , data: {
                    formData: formData
                }
                , success: function(data) {
                    
                    if (data.error) {
                        printErrorMsg(data.error);
                        return false;
                    } else if (data.status == "200") {
                        
                        var success_message = data.message;
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: success_message ,
                            position: 'top-right',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            // footer: '<a href="">Click to open</a>',
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    }

                }
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });

        /////////////////////////////

    });


    //////////////////////
                
    function postAction(post_id = '', param = '', postType = '',like_from_popup='') {
        let _token = $("input[name=_token]").val();
        
        var isLike = parseInt($(".post-like" + post_id).attr('isLike'));
        var is_save = parseInt($(".post-book" + post_id).attr('is_save'));
        isLike = (isLike==0) ? 1 : 0;
        is_save = (is_save==0) ? 1 : 0;
        
        data = {
            post_id: post_id,
            param: param,
            type: postType,
            _token: _token,
        };
        
        if(postType=='is_like')
        {
            $(".post-like" + post_id).addClass('disabled');
            
            data.is_like = isLike;
        }
        
        if(postType=='is_save')
        {
            data.is_save = is_save;
        }   
        
        $.ajax({
            url: "{{route('post_activity_action')}}"
            , type: "POST"
            , data: data
            , dataType: 'JSON'
            , success: function(data) {
                if(postType=='is_like')
                {
                    $(".post-like" + post_id).removeClass('disabled');
                }
                if (data.error) {
                    // printErrorMsg(data.error);
                    console.log('Something went wrong !' + data.error);
                    return false;
                } else if (data.status == "200")
                {
                    var rs = data.data;
                    // console.log("For Like count = ",rs);
                    if(postType=="is_like")
                    {
                        $(".likedByUserPhoto" + post_id).html('');
                        $(".likedByNameCount" + post_id).html('');
                        var $postLikeElement = $(".post-like" + post_id);
                    
                        // var isLikeCount = parseInt($(".post-like" + post_id).attr('isLike'));
                        var isLikeCount = rs.is_like;
                        var is_like_count = (isLikeCount == 0) ? 1 : 0;        
                        if(is_like_count==1)
                        {
                            //var currentCount = parseInt($(".post-like" + post_id).attr('postLikeCount'));
                            // var newCount = currentCount + 1;
                            var newCount = rs.count_is_like;
                            
                            $(".post-like" + post_id).attr('postLikeCount', newCount);
                            $(".post-like" + post_id).attr('isLike', rs.is_like);
                            $(".count_is_like" + post_id).html(newCount); 
                            // $(".post-like" + post_id).toggleClass("active");
                            // $(".post-like" + post_id).addClass("active");
                            $postLikeElement.removeClass("active");                                             
                            
                            //// Start code to show Like members
                            if(rs.count_is_like>0)
                            {
                                var userName = rs.post_activity[0].user.first_name+ ' '+rs.post_activity[0].user.last_name;
                                var profile_image_url = rs.post_activity[0].user.profile_image_url;
                                var otherLikeCount = 'Liked by '+ userName + ' and ' + (rs.count_is_like-1)+ ' others';
                                $(".likedByNameCount" + post_id).html(otherLikeCount);
                                
                                $(".likedByUserPhoto" + post_id).html('');
                                for (var i = 0; i < rs.post_activity.length; i++)
                                {
                                    var userName = rs.post_activity[i].user.first_name+ ' '+rs.post_activity[i].user.last_name;
                                    var profile_image_url = rs.post_activity[i].user.profile_image_url;
                                    var profile_img = '<div class="avtar-25 shadow bg-white"><img src='+profile_image_url+' alt='+userName+' title='+userName+'></div>';
                                    $(".likedByUserPhoto" + post_id).append(profile_img);
                                }
                            }
                            //// End code to show Like members
                        }
                        else
                        {
                            // var currentCount = parseInt($(".post-like" + post_id).attr('postLikeCount'));
                            // var newCount = currentCount - 1;
                            var newCount = rs.count_is_like;
                            $(".post-like" + post_id).attr('postLikeCount', newCount);
                            $(".post-like" + post_id).attr('isLike', rs.is_like);
                            $(".count_is_like" + post_id).html(newCount);
                            // $(".post-like" + post_id).toggleClass("active");
                            // $(".post-like" + post_id).removeClass("active");
                            
                            $postLikeElement.addClass("active");       
                            
                            //// Start code to show Like members
                            if(rs.count_is_like>0)
                            {
                                var userName = rs.post_activity[0].user.first_name+ ' '+rs.post_activity[0].user.last_name;
                                var profile_image_url = rs.post_activity[0].user.profile_image_url;
                                var otherLikeCount = 'Liked by '+ userName + ' and ' + (rs.count_is_like-1)+ ' others';
                                $(".likedByNameCount" + post_id).html(otherLikeCount);
                                
                                $(".likedByUserPhoto" + post_id).html('');
                                
                                for (var i = 0; i < rs.post_activity.length; i++)
                                {
                                    var userName = rs.post_activity[i].user.first_name+ ' '+rs.post_activity[i].user.last_name;
                                    var profile_image_url = rs.post_activity[i].user.profile_image_url;
                                    var profile_img = '<div class="avtar-25 shadow bg-white"><img src='+profile_image_url+' alt='+userName+' title='+userName+'></div>';
                                    $(".likedByUserPhoto" + post_id).append(profile_img);
                                }
                            }
                            else
                            {
                                $(".likedByUserPhoto" + post_id).html('');
                                $(".likedByNameCount" + post_id).html('');
                            }
                            //// End code to show Like members
                        }
                    }
                    
                    if(postType=="is_save")
                    {
                        var $postBookElement = $(".post-book" + post_id);
                        var isSave = parseInt($postBookElement.attr('is_save'));        
                        if(isSave==1)
                        {
                            $(".is_save_text" + post_id).html('Save'); 
                            $postBookElement.attr('is_save', 0);
                            // $postBookElement.toggleClass("active");
                            $postBookElement.removeClass("active");
                            $postBookElement.attr("data-bs-original-title", "save this Post");
                        }
                        else
                        {
                            $(".is_save_text" + post_id).html('Saved'); 
                            $postBookElement.attr('is_save', 1);
                            // $postBookElement.toggleClass("active");
                            $postBookElement.addClass("active");
                            $postBookElement.attr("data-bs-original-title", "Unsave this Post");
                            
                        }
                    }
                    
                    if(postType!="is_like" && postType!="is_save")
                    {
                        getData();
                    }
                    if(like_from_popup==1)
                    {
                        console.log(data,rs.id);
                        getData();
                        
                        getPostdetail(rs.id)
                    }
                    
                        
                    var success_message = data.message;
                    // console.log(success_message);
                    Swal.fire({
                        toast: true,
                        icon: 'success',
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
                if(postType=='is_like')
                {
                    $(".post-like" + post_id).removeClass('disabled');
                }
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                                        
                    var message = errorMessage;
                    // console.log(success_message);
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: message,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                    
                    console.log(errorMessage);
                }
        });
    }
    $(document).on("click",".toggleFeatured", function(e) {
        e.preventDefault();
        var post_id = $(this).attr("data-id-fetured");
        // var is_featured = $(this).attr("is-featured");

        let url = '{{ route("posts.featured.post.status.update", ":id") }}';
        url = url.replace(':id', post_id);

        // formData = '';
        $.ajax({
            url: url
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: {
                // id: post_id,
                // is_featured: is_featured,
            }
            , dataType: 'JSON'            
            , contentType: false
            , processData: false 
            , success: function(data) {
               
                if (data.error) {
                    return false;
                } else if (data.status == "200") {
                    var success_message = data.message;                                    
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: success_message ,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    // window.location.reload(); 
                    getData();                
                    getFeaturedPost();        
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                              
                var errorMessage = (jqXHR.responseJSON && jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : "An error occurred: " + errorThrown;
                $('#errorField').text(jqXHR.responseJSON.message);
                console.log(jqXHR.responseJSON.message);
            }
        });
    });
    
    function reportAction(post_id = '', param = '', report_for ='') {
        let _token = $("input[name=_token]").val();

      var report_des = '';
      
      if(report_for=="post")
      {
        var checkboxName = "reportPostReason";
        report_des = document.getElementById("reportPostDescription").value;
      }
      
      if(report_for=="member")
      {
        var checkboxName = "is_report_member";
        report_des = '';
      }
      
      var reportPostReason = [];
      // get all checked checkboxes with the given name
      var checkboxes = document.querySelectorAll("input[name='" + checkboxName + "']:checked");

      console.log(checkboxes.length);
      // iterate over the checked checkboxes and extract their values
      for (var i = 0; i < checkboxes.length; i++) {
        reportPostReason.push(checkboxes[i].value);
      }
      
      let reportPostReason_string = reportPostReason.toString();

        $.ajax({
            url: "{{route('report')}}"
            , type: "POST"
            , data: {
                post_id: post_id
                , report_for: report_for
                , report_type: reportPostReason_string
                , report_description: report_des
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {
                getData();

                if (data.error) {
                    // printErrorMsg(data.error);
                    return false;
                } else if (data.status == "200") {

                }
            }
        });
    }
    

    function OpenConfirmModal(post_id = '', param = '', type = '', modalId = '') {
        $('#post_id').val(post_id);
        $('#param').val(param);
        $('#type').val(type);
        $('#modalId').val(modalId);
        // console.log(modalId);
        if (modalId != '') {
            $(modalId).modal('show');
        }
    }

    function OpenConfirmModalFinal(report_for='') {
        var post_id = $('#post_id').val();
        var param = $('#param').val();
        var type = $('#type').val();
        var modalId = $('#modalId').val();

        console.log(modalId);
        
        if((type=="is_report" || type=="is_report_member") && report_for!='')
        {
          reportAction(post_id, param, report_for);
        }
        else{
          postAction(post_id, param, type);
        }
        $(modalId).modal('hide');
    }

    function GetDeletModal(delet_post_id)
    {
        $("#delet_post_id").val(delet_post_id);
        $('#exampleModal4').modal('show');
    }
   
    function delete_post() {
        let _token = $("input[name=_token]").val();
        var id = $("#delet_post_id").val();
        let url = '{{ route("posts.delete", ":id") }}';
        url = url.replace(':id', id);
        $.ajax({
            url: url
            , method: "delete"
            , data: {
                _token: _token
                , id: id
            }
        }).done(function(data) {
            getData();
            getFeaturedPost();
            $("#delet_post_id").val('');
            $('#exampleModal4').modal('hide');
        });
    }
    
    function getDeletPostCommentModal(post_id,post_comment_id,deletedFromPopup='')
    {
        $("#cmt_post_id").val(post_id);
        $("#post_comment_id").val(post_comment_id);
        $("#deletedFromPopup").val(deletedFromPopup);
        $('#DeletPostCommentModal').modal('show');
    }  
    function delete_post_comment() {
        let _token = $("input[name=_token]").val();
        var post_id = $("#cmt_post_id").val();
        var post_comment_id = $("#post_comment_id").val();
        var deletedFromPopup = $("#deletedFromPopup").val();

        
        var url = '{{ route("post.comment.delete", ["post" => ":post", "postComment" => ":postComment"]) }}';
        url = url.replace(':post', post_id);
        url = url.replace(':postComment', post_comment_id);

         $.ajax({
            url: url
            , method: "delete"
            , data: {
                _token: _token
            }
        }).done(function(data) {
            if(deletedFromPopup==1)
            {
                getPostdetail(post_id);
            }
            if(deletedFromPopup==2)
            {
                getMoreCommentsPopup(post_id);
            }
            getData();
            
            var message = data.message;                                    
            Swal.fire({
                toast: true,
                icon: 'warning',
                title: message ,
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: false,
                // footer: '<a href="">Click to open</a>',
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
                
            $("#cmt_post_id").val('');
            $("#post_comment_id").val('');
            $('#DeletPostCommentModal').modal('hide');
        });
    }
    
    

    function addOpenClass() {
        $('.dropdown dropdown-submenu toggler').addClass('open');
    }

    function update_post_type(param = 'post') {
        $('#post_type').val(param);
        $('.print-error-msg').html('');

        console.log($('#post_type').val());
        if (param == 'post') {
            $('.content_error').html('');
            $('.article_content_error').html('');
            $('.print-error-msg').html('');
        }
        if (param == 'article') {
            $('.content_error').html('');
            $('.article_content_error').html('');
            $('.print-error-msg').html('');
        }
    }

    function getData(page = '1') {
        $.ajax({
                url: '{{ route("posts.index") }}?page=' + page
                , type: "get"
                , beforeSend: function() {
                    $('.ajax-load').show();
                }
            })
            .done(function(data) {
                if (data.html == " ") {
                    $('.ajax-load').html("No more records found");
                    return;
                }
                $('.ajax-load').hide();
                $("#post-data").html(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('server not responding...');

            });
    }
    function getFeaturedPost(){
        var url = '{{ route("post.featuredpost") }}';
        $.ajax({
                url: url
                , type: "get"
            })
            .done(function(data) {
                $(".featuredPost").html(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('server not responding...');
            });
    }
    getFeaturedPost();
    // var page = 1;
    // loadMoreData(page);
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
    //         page++;
    //         loadMoreData(page);
    //     }
    // });


    // function loadMoreData(page='1') {

    //     // var start = Number($('#start').val());
    //     // var allcount = Number($('#totalrecords').val());
    //     // var rowperpage = Number($('#rowperpage').val());
    //     // start = start + rowperpage;

    //     // if (start <= allcount) {
    //     //     $('#start').val(start);


    //         $.ajax({
    //                 url: '{{ route("posts.index") }}?post_type=all&page=' + page
    //                 , type: "get"
    //                 , beforeSend: function() {
    //                     $('.ajax-load').show();
    //                 }
    //             })
    //             .done(function(data) {
    //                 // console.log(data);
    //                 if (data.html == " ") {
    //                     $('.ajax-load').html("No more records found");
    //                     return;
    //                 }
    //                 $('.ajax-load').hide();
    //                 $("#post-data").append(data.html);
    //             })
    //             .fail(function(jqXHR, ajaxOptions, thrownError) {
    //                 console.log('Server error occured');
    //             });
    //     //}
    // }
    
    
    //////////////////// Post Pagination //////////////////////////////////////
    
// var page = 1;
// var isLoadingData = false;
// var hasMoreData = true;

// $(window).scroll(function() {
//     if (!isLoadingData && hasMoreData && $(window).scrollTop() + $(window).height() >= $(document).height()) {
//         isLoadingData = true;
//         page++;
//         loadMoreData(page);
//     }
// });

// function loadMoreData(page) {
//     console.log('loadMoreData function called');
//     $.ajax({
//         url: '{{ route("posts.index") }}?post_type=all&page=' + page,
//         type: "get",
//         beforeSend: function() {
//             $('.ajax-load').show();
//         }
//     })
//     .done(function(data) {
//         console.log(data);
//         isLoadingData = false;
//         if (data.html.trim() === "") {
//             hasMoreData = false; // No more data available, so set hasMoreData to false.
//             $('.ajax-load').html("No more records found");
//         } else {
//             $('.ajax-load').hide();
//             $("#post-data").append(data.html);
            
//             if (data.current_page <= data.last_page ) {
//                 hasMoreData = true;
//             } else {
//                 hasMoreData = false;
//             }
//         }
//     })
//     .fail(function(jqXHR, ajaxOptions, thrownError) {
//         isLoadingData = false;
//         console.log('Server error occurred');
//     });
// }


var page = 1;
var isLoadingData = false;
var hasMoreData = true;
$(window).scroll(function() {
    if (!isLoadingData && hasMoreData && $(window).scrollTop() + $(window).height() >= $(document).height()) {
        isLoadingData = true;
        page++;
        loadMoreData(page);
    }
});

function loadMoreData(page) {
    console.log('loadMoreData function called');
    $.ajax({
        url: '{{ route("posts.index") }}?post_type=all&page=' + page,
        type: "get",
        beforeSend: function() {
            console.log('ajax-load show called');
            // showLoader();
            $('.loader-list').show(); // Show loader before making the request
        }
    })
    .done(function(data) {
        console.log(data);
        isLoadingData = false;
        if (data.html.trim() === "") {
            hasMoreData = false;
            $('.ajax-load').html("No more records found");
        } else {
            $('.ajax-load').hide();
            $("#post-data").append(data.html);
            
            if (data.current_page <= data.last_page) {
                hasMoreData = true;
            } else {
                hasMoreData = false;
            }
        }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError) {
        isLoadingData = false;
        console.log('Server error occurred');
    })
    .always(function() {
        console.log('ajax-load hide called');
        //hideLoader();
        $('.loader-list').hide(); // Hide loader regardless of success or failure
    });
}

////////////////////////////////////////////
    
    function cmt_reply(reply_id = '') {
            $('.lm_rep').removeClass('active');
            $('.lm_rep'+reply_id).addClass('active');
            $(".yourReply").removeClass('errorClass');
            
            $(".emojionearea-editor").html('');
    }
    function cmtReplyCancel(reply_id = '') {
        $('.lm_rep'+reply_id).removeClass('active');
        $(".yourReply").removeClass('errorClass');
    }

    function cancelThought(post_id = '') {
        $('.post_cmtt-show' + post_id).removeClass('active');
        $(".yourComment" + post_id).removeClass('errorClass');
    }
    
    function shareYourAnswer(post_id = '',i='') {
       // alert("#yourThoughts" + post_id);
       // $(".emoji-wysiwyg-editor")[0].attr("tabindex",-1).focus();
        //document.getElementsByClassName("emoji-wysiwyg-editor")[0].attr("tabindex",-1).focus();
        
        console.log(i);
        (document.getElementsByClassName("emoji-wysiwyg-editor")[i].focus());
        
        // $("#yourThoughts" + post_id).focus();
    }
    
    

    function SubmitYourThought(id = '') {
        $("#comment_submit_btn" + id).prop('disabled', true); // Disable the button
        $(".comment-error"+id).html('');
        
        let _token = $("input[name=_token]").val();
        var yourThoughts = $("#yourThoughts" + id).val();        
        // $(yourThoughts).css('border-color', '');
        if (yourThoughts == '') {
            console.log('Comment can not be blank!');
             
           $(".comment-error"+id).html('Comment can not be blank!');
            return false;
        } else {        
            var url = "{{route('posts.comment.store', ":id")}}";
            url = url.replace(":id", id);
            
            // $("#post_cmt_id").val(id);
            $.ajax({
                url: url
                , type: "POST"
                , data: {
                    parent_id: ''
                    , comment_text: yourThoughts
                    , _token: _token
                , }
                , dataType: 'JSON'
                , success: function(data)
                {
                    $("#comment_submit_btn" + id).prop('disabled', false);
                    var comment_text = data.data.post_comments[0].comment_text;
                    
                    $(".comment_text"+id).html(comment_text);
                    var cmtuser = data.data.post_comments[0].user;
                    
                    var cmt = `<div class="d-flex gap-2"><div class="avtar p-0">
                            <img class="rounded-circle" src="`+cmtuser.profile_image_url+`" alt="">
                        </div>
                        <div class="d-lnline text-start">
                            <p class="mb-0 lh-sm title-font text-dark fw-bold">
                                `+cmtuser.first_name+` `+ ' ' +` `+cmtuser.last_name+`
                            </p>
                            <p class="mb-0 lh-sm text-sm-12">`+cmtuser.user_type+`</p>
                        </div>
                        <span class="title-font text-sm-10">`+data.data.post_comments[0].created_at+`</span></div>`;
                
                    
                
    
                    cmt += `<div class="lm_cm-rep text-start mx-5 my-1"><p class="text-sm-16 text-dark mb-0 title-font comment_text`+id+`">`+comment_text+`</p>`;
                    // if(data.data.replies!='' && data.data.replies>0)
                    // {
                        cmt += `<div class="lm_rep d-flex gap-2"><a onclick="getMoreCommentsPopup(`+id+`)" class="text-primary title-font text-sm-16" type="button">Reply</a>`;
                    // }
                    // cmt += `<a class="text-primary title-font text-sm-14" type="button">Reply</a></div>`;
                    
                    cmt += `<a onclick="getDeletPostCommentModal(`+id+`,`+data.data.post_comments[0].id+`)" class="text-primary title-font text-sm-16" type="button">Delete</a>`;
                    
                    
                    
                    
                    $(".cmt_user_detail"+id).html(cmt);
                    $(".cmt_user_detail_popup"+id).html(cmt);
                    
                    var countComments = parseInt($(".count_comments"+id).html());
                    $(".count_comments"+id).html(countComments+1);
                    $(".post_cmtt_popup"+id).html(countComments+1);
                    
                    $(".post_cmtt"+id).html('');
                    $(".post_cmtt"+id).val('');
                    
                    // getData();

                    if (data.error) {
                        $("#comment_submit_btn" + id).prop('disabled', false);
                        return false;
                    } else if (data.status == "200") {
                        
                        // getData();
                        
                        $(".comment-error"+id).html('');
                        
                        var success_message = data.message;
                        // console.log(success_message);
                        Swal.fire({
                            toast: true,
                            icon: 'success',
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
                    $("#comment_submit_btn" + id).prop('disabled', false);
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                                        
                    var message = errorMessage;
                    // console.log(success_message);
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: message,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                    
                    console.log(errorMessage);
                }
            });
        }
    }
    function SubmitYourThoughtPopup(id = '') {
        $("#comment_submit_popup_btn" + id).prop('disabled', true); // Disable the button
        $(".comment-error-popup"+id).html('');
        
        let _token = $("input[name=_token]").val();
        var yourThoughts = $("#yourThoughtsPopup" + id).val();
        // $(yourThoughts).css('border-color', '');
        if (yourThoughts == '') {
            console.log('Comment can not be blank!');
             
           $(".comment-error-popup"+id).html('Comment can not be blank!');
            return false;
        } else {
            var url = "{{route('posts.comment.store', ":id")}}";
            url = url.replace(":id", id);
            
            // $("#post_cmt_id").val(id);
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: _token,
                    parent_id: '',
                    comment_text: yourThoughts
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function(data)
                {
                    $("#comment_submit_popup_btn" + id).prop('disabled', false);
                    //console.log(data.data.post_comments[0].comment_text);
                    
                    var comment_text = data.data.post_comments[0].comment_text;
                    
                    $(".comment_text_popup"+id).html(comment_text);
                    var cmtuser = data.data.post_comments[0].user;
                    console.log(data);
                    
                    
                    var cmt = `<div class="d-flex gap-2"><div class="avtar p-0">
                            <img class="rounded-circle" src="`+cmtuser.profile_image_url+`" alt="">
                        </div>
                        <div class="d-lnline text-start">
                            <p class="mb-0 lh-sm title-font text-dark fw-bold">
                                `+cmtuser.first_name+` `+ ' ' +` `+cmtuser.last_name+`
                            </p>
                            <p class="mb-0 lh-sm text-sm-12">`+cmtuser.user_type+`</p>
                        </div>
                        <span class="title-font text-sm-10">`+data.data.post_comments[0].created_at+`</span></div>`;
                
                    
                
    
                    cmt += `<div class="lm_cm-rep text-start mx-5 my-1"><p class="text-sm-16 text-dark mb-0 title-font comment_text_popup`+id+`">`+comment_text+`</p>`;
                    // if(data.data.replies!='' && data.data.replies>0)
                    // {
                        cmt += `<div class="lm_rep d-flex gap-2"><a onclick="getMoreCommentsPopup(`+id+`)" class="text-primary title-font text-sm-16" type="button">Reply</a>`;
                    // }
                    // cmt += `<a class="text-primary title-font text-sm-14" type="button">Reply</a></div>`;
                    cmt += `<a onclick="getDeletPostCommentModal(`+id+`,`+data.data.post_comments[0].id+`,1)" class="text-primary title-font text-sm-16" type="button">Delete</a>`;
                    
                    ///////////////////////////////////////////////
                    
                                
                    $(".cmt_user_detail_popup"+id).html(cmt);
                    $(".cmt_user_detail"+id).html(cmt);
                    
                    var countComments = parseInt($(".count_comments_popup"+id).html());
                    $(".count_comments_popup"+id).html(countComments+1);
                    $(".count_comments"+id).html(countComments+1);
                    
                    $(".post_cmtt_popup"+id).html('');
                    $(".post_cmtt_popup"+id).val('');
                    
                    // getData();

                    if (data.error) {
                        $("#comment_submit_popup_btn" + id).prop('disabled', false);
                        return false;
                    } else if (data.status == "200") {
                        
                        $(".comment-error-popup"+id).html('');
                        
                        var success_message = data.message;
                        // console.log(success_message);
                        Swal.fire({
                            toast: true,
                            icon: 'success',
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
                    $("#comment_submit_popup_btn" + id).prop('disabled', false);
                    var errorMessage = "An error occurred. Please try again."; // Default error message
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        // console.log(xhr.responseJSON);
                        errorMessage = xhr.responseJSON.message; // Use the error message from the API response
                    }
                    // Set the error message in the desired HTML tag
                                        
                    var message = errorMessage;
                    // console.log(success_message);
                    Swal.fire({
                        toast: true,
                        icon: 'warning',
                        title: message,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                    
                    console.log(errorMessage);
                }
            });
        }
    }
    function writeComment() {
        var id = $("#post_cmt_id").val();
        let _token = $("input[name=_token]").val();
        var yourThoughts = $(".yourComment").val();
        if (yourThoughts == '') {
            console.log('Comment can not be blank!');
            $(".yourComment").addClass('errorClass');
            return false;
        } else {
            var url = "{{route('posts.comment.store', ":id")}}";
            url = url.replace(":id", id);

            $.ajax({
                url: url
                , type: "POST"
                , data: {
                    parent_id: ''
                    , comment_text: yourThoughts
                    , _token: _token
                , }
                , dataType: 'JSON'
                , success: function(data) {
                    $(".yourComment").val('');
                    $(".yourComment").html('');
                    $(".post_cmtt").val('');
                    
                    $(".emojionearea-editor").html('');
                    
                    getMoreCommentsPopup(id);
                    getData();
                    console.log(data);
                    if (data.error) {
                        return false;
                    } else if (data.status == "200") {

                    }
                }
            });
        }
    }
    
    function pollActivity(poll_option_id,total_answered_member_count='1',total_answer_on_this_question_count='') {
        let _token = $("input[name=_token]").val();
        var url = "{{route('poll.answer', ":poll_option_id")}}";
        url = url.replace(":id", poll_option_id);
        
        $.ajax({
            url: url
            , type: "POST"
            , data: {
                poll_option_id: poll_option_id
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {

            $.each(data.data.poll_options, function(index, option) {
                poll_option_id = option.id;
                var isAnswered = option.is_answered;
                var optionText = option.option;
                var post_id = option.post_id;
                var totalAnswerOnThisQuestion = option.total_answer_on_this_question_count;
                var totalAnsweredMember = option.total_answered_member_count;
                    
                var element = document.querySelector('.multiple-choice-progress-bar' + poll_option_id);
                percentage = 0;
                var newCount = 0;
                $(".is_answered" + poll_option_id).attr('totalAnsweredMember', totalAnsweredMember);
                $(".is_answered" + poll_option_id).attr('totalAnswerOnThisQuestion', totalAnswerOnThisQuestion);
                
                if(isAnswered==1)
                {
                    $(".is_answered" + poll_option_id).attr('isAnswered', 1);
                    $(".total_member_voted" + poll_option_id).html(totalAnsweredMember + ' votes');   
                    $(".multiple-choice-progress-bar" + poll_option_id).toggleClass("voted");
                    percentage = ((totalAnsweredMember/totalAnswerOnThisQuestion) * 100).toFixed(2);
                    if(totalAnsweredMember==0)
                    {
                        element.style.width = '0%';
                    }
                    else
                    {
                        element.style.width = percentage + '%';
                    }                    
                }
                else
                {
                    $(".is_answered" + poll_option_id).attr('isAnswered', 0);
                    $(".total_member_voted" + poll_option_id).html(totalAnsweredMember + ' votes');
                    $(".multiple-choice-progress-bar" + poll_option_id).removeClass("voted");
                    percentage = ((totalAnsweredMember/totalAnswerOnThisQuestion) * 100).toFixed(2);
                    if(totalAnsweredMember==0)
                    {
                        element.style.width = '0%';
                    }
                    else
                    {
                        element.style.width = percentage + '%';
                    }
                }
            }); 
                if (data.error) {
                    return false;
                } else if (data.status == "200") {

                }
            }
        });
    }
    
    function pollPercentageActivity(poll_option_id,post_id='') {
        let _token = $("input[name=_token]").val();
        var url = "{{route('poll.answer', ":poll_option_id")}}";
        url = url.replace(":id", poll_option_id);

        $.ajax({
            url: url
            , type: "POST"
            , data: {
                poll_option_id: poll_option_id
                , _token: _token
            , }
            , dataType: 'JSON'
            , success: function(data) {
                                    
                $.each(data.data.poll_options, function(index, option) {
                poll_option_id = option.id;
                var isAnswered = option.is_answered;
                var optionText = option.option;
                var post_id = option.post_id;
                var totalAnswerOnThisQuestion = option.total_answer_on_this_question_count ?? 0;
                var totalAnsweredMember = option.total_answered_member_count ?? 0;
                    
                var element = document.querySelector('.percentage-progress-bar' + poll_option_id);
                percentage = 0;
                var newCount = 0;
                $(".is_answered" + poll_option_id).attr('totalAnsweredMember', totalAnsweredMember);
                $(".is_answered" + poll_option_id).attr('totalAnswerOnThisQuestion', totalAnswerOnThisQuestion);
                
                if(isAnswered==1)
                {
                    $(".is_answered" + poll_option_id).attr('isAnswered', 1);                       
                    percentage = (((totalAnsweredMember/totalAnswerOnThisQuestion) * 100).toFixed(0)) ?? 0;
                    $(".total_member_voted" + poll_option_id).html(percentage + ' %');   
                    if(totalAnsweredMember==0)
                    {
                        element.style.width = '0%';
                    }
                    else
                    {
                        element.style.width = percentage + '%';
                    }                     
                }
                else
                {
                    $(".is_answered" + poll_option_id).prop('checked', false);
                    $(".is_answered" + poll_option_id).attr('isAnswered', 0);
                    if(isAnswered==0 && totalAnswerOnThisQuestion==0)
                    {
                        percentage = 0;
                    }
                    else
                    {
                        percentage = (((totalAnsweredMember/totalAnswerOnThisQuestion) * 100).toFixed(0)) ?? 0;
                    }                        
                    $(".total_member_voted" + poll_option_id).html(percentage + ' %');
                    if(totalAnsweredMember==0)
                    {
                        element.style.width = '0%';
                    }
                    else
                    {
                        element.style.width = percentage + '%';
                    }
                }
            });
                if (data.error) {
                    return false;
                } else if (data.status == "200") {

                }
            }
        });
    }
    
    function writeReply(parent_id='') {
        var id = $("#post_cmt_id").val();
        
        // console.log(id);
        let _token = $("input[name=_token]").val();
        var yourReply = $("#yourReply"+parent_id).val();
        
        if(yourReply=='')
        {
            console.log('Reply Can not be blank!');
            $("#yourReply"+parent_id).addClass('errorClass');
            return false;
        }else{
            var url = "{{route('posts.comment.store', ":id")}}";
            url = url.replace(":id", id);

            $.ajax({
                url: url
                , type: "POST"
                , data: {
                    parent_id: parent_id
                    , comment_text: yourReply
                    , _token: _token
                , }
                , dataType: 'JSON'
                , success: function(data) {
                    $("#yourReply"+parent_id).val('');
                    getMoreCommentsPopup(id);
                    getData();
                    console.log(data);
                    if (data.error) {
                        return false;
                    } else if (data.status == "200") {

                    }
                }
            });
        }
    }


    function getMoreCommentsPopup(id = '') {
        $(".emojionearea-editor").html('');
        // $('#exampleModal13').modal('show');
        $("#post_cmt_id").val(id);
        var url = "{{route('posts.comment.index', ":id")}}";
        url = url.replace(":id", id);
        // alert(id);

        $.ajax({
                url: url
                , type: "get"
                , beforeSend: function() {
                    $('.ajax-load').show();
                }
            })
            .done(function(response) {
                $(".commentsReplyData").html(response.html);
                $('.ajax-load').hide();
                $('#exampleModal13').modal('show');
                $('#postDetailModal').modal('hide');
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });


    }
    

    function SubmitYourReply(id = '', parent_id = '') {
        let _token = $("input[name=_token]").val();
        var yourThoughts = $(".yourComment").val();
        if (yourThoughts == '') {
            console.log('Comment can not be blank!');
            $(".yourComment").addClass('errorClass');
            return false;
        } else {
            var url = "{{route('posts.comment.store', ":id")}}";
            url = url.replace(":id", id);

            $.ajax({
                url: url
                , type: "POST"
                , data: {
                    parent_id: parent_id
                    , comment_text: yourThoughts
                    , _token: _token
                , }
                , dataType: 'JSON'
                , success: function(data) {
                    getData();

                    if (data.error) {
                        return false;
                    } else if (data.status == "200") {

                    }
                }
            });
        }
    }


    $(document).ready(function() {
        $('input:radio').click(function() {
        $('input:radio[name='+$(this).attr('name')+']').parent().removeClass('checked11');
            $(this).parent().addClass('checked11');

        });
             
        $('.js-example-basic-single').select2();

        $('#select_box').change(function() {
            var select = $(this).find(':selected').val();
            if (select == "poll_question") {
                // $('#post_type').val(select);
                $(".multi_choice_hide").hide();
                $(".poll_expiration_hide").hide();
            }
            if (select == "poll_multiple_choice") {
                $("#poll_ques").focus();                  
                $('#post_type').val(select);
                $(".multi_choice_hide").show();
                $(".poll_expiration_hide").show();
            }
            if (select == "poll_percentage") {
                $('#post_type').val(select);
                $(".multi_choice_hide").hide();
                $(".poll_expiration_hide").show();
                
            }
        }).trigger('change');


        
        var i = 0; // Counter for unique IDs

    // Add input field
    $('.add_poll_choice_btn').on('click', function() {
        i++;

        var link = '<div class="d-flex mb-3" id="add_choice' + i + '">';
        link += '<input class="form-control shadow py-2" type="text" name="add_choice[]" placeholder="Add a choice" value="">';
        link += '<span class="lm_form-add shadow ms-3 remove_poll_choice_btn"><img src="{{asset('assets/images/minus.svg')}}" alt=""></span>';
        link += '</div>';

        $('.poll_choice_append').append(link);
    });

    // Remove input field
    $(document).on('click', '.remove_poll_choice_btn', function() {
        $(this).closest('.d-flex').remove();
    });
    
    

        // var i = 0; // Counter for unique IDs
        // $('.add_poll_choice_btn').on('click', function() {
        //     i++;
        //     console.log(i);

        //     var link = '<div class="d-flex mb-3" id="add_choice' + i + '">'
        //     link += '<input class="form-control shadow py-2" type="text" name="add_choice[]" placeholder="Add a choice" value=""><span class="lm_form-add shadow ms-3 remove_poll_choice_btn" onclick="remove_added_poll_choice(' + i + ')"><img src="{{asset('assets/images/minus.svg')}}" alt=""></span>'
        //     link += '</div>'

        //     $('.poll_choice_append').append(link);
        //     console.log(link);
        //     return false;
        // });

        // var i = 1;
        // $('.add_poll_choice_btn').on('click', function() {
        //     i++;
        //     console.log(i);


        //     var link = '<div class="d-flex mb-3 " id="add_choice' + i + '">'
        //     link += '<input class="form-control shadow py-2" type="text" name="add_choice[]" placeholder="Add a choice" value=""><span class="lm_form-add shadow ms-3 remove_poll_choice_btn" onclick="remove_added_poll_choice(' + i + ')"><img src="{{asset('assets/images/trash.svg')}}" alt=""></span>'
        //     link += '</div>'

        //     $('.poll_choice_append').append(link)
        //     console.log(link);
        //     return false;
        // });

    });

    // function remove_added_poll_choice(id = '') {
    //     var button_id = id;
    //     $('#add_choice' + button_id + '').remove();
    //     return false;
    // }


    $(document).ready(function() {
        
        var postId = '{{ request()->query('postId') }}';
        // alert(postId);
        if(postId)
        {
            getPostdetail(postId);
        }        
        $('input[name="poll_content"]').keyup(function() {
        });
    });

    function formatDate(date_temp = '') {
        var input = document.getElementById(date_temp);
        var date = new Date(input.value);

        // Adjust for time zone offset
        var timeZoneOffset = date.getTimezoneOffset() * 60000;
        date.setTime(date.getTime() - timeZoneOffset);

        var formattedDate = date.toISOString().replace("T", " ").slice(0, -5);

        var input_date = date_temp.replace("_temp", "");
        $("#" + input_date).val(formattedDate);
    }

    function copy_post(id) {
        url = '{{ route("posts.index") }}?postId=' + id;
        var tempInput = $('<input>'); // Create a temporary input element
        $('body').append(tempInput); // Append the temporary input element to the document
        tempInput.val(url).select(); // Set the value of the temporary input element to the text and select it
        document.execCommand('copy'); // Copy the selected text to the clipboard
        tempInput.remove(); // Remove the temporary input element from the document
        
        var success_message = 'User has copied the post link.';
        Swal.fire({
            toast: true,
            icon: 'success',
            title: success_message ,
            position: 'top-right',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            // footer: '<a href="">Click to open</a>',
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    }
  
    function getPostdetail(id = '') {
        var url = "{{route('show', ":id")}}";
        url = url.replace(":id", id);
        $.ajax({
                url: url
                , type: "get"
                , beforeSend: function() {
                    $('.ajax-load').show();
                }
            })
            .done(function(response) {
                $(".appendPostdetail").html(response.html);
                $('.ajax-load').hide();
                $('#postDetailModal').modal('show');

            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }    
</script>


<!-- Begin emoji-picker -->
<!-- Begin emoji-picker JavaScript -->
<script src="{{ asset('assets/emoji/js/config.min.js')}}"></script>
<script src="{{ asset('assets/emoji/js/util.min.js')}}"></script>
<script src="{{ asset('assets/emoji/js/jquery.emojiarea.min.js')}}"></script>
<script src="{{ asset('assets/emoji/js/emoji-picker.min.js')}}"></script>
<!-- End emoji-picker JavaScript -->

<script>
    var assetsPath = "{{ asset('assets/emoji/img/')}}";
    $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: assetsPath,
        popupButtonClasses: 'fa fa-smile-o'
      });
      // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
      // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
      // It can be called as many times as necessary; previously converted input fields will not be converted again
      window.emojiPicker.discover();
    });
</script>
<!-- End emoji-picker -->


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
    integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"
    integrity="sha512-+UiyfI4KyV1uypmEqz9cOIJNwye+u+S58/hSwKEAeUMViTTqM9/L4lqu8UxJzhmzGpms8PzFJDzEqXL9niHyjA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.js"
    integrity="sha512-9yoLVdmrMyzsX6TyGOawljEm8rPoM5oNmdUiQvhJuJPTk1qoycCK7HdRWZ10vRRlDlUVhCA/ytqCy78+UujHng=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
    integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.js"
    integrity="sha512-L7jgg7T9UbYc7hXogUKssqe1B5MsgrcviNxsRbO53dDSiw/JxuA/4kVQvEORmZJ6Re3fVF3byN5TT7czo9Rdug=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // Initialize the DateTimePicker
    $(document).ready(function() {
        $('#datetimepicker').datetimepicker({
            format: 'Y-m-d H:i',
            minDate: 0,
            timepicker: true
        });
    });
</script> --}}
<script>
    // Initialize the DateTimePicker
  $(document).ready(function() {
      $('#poll_expiration').datetimepicker({
          format: 'd-M-Y H:i',
          minDate: 0,
          timepicker: true,
          step: 1,
          defaultDate: new Date(currDate()),
          
      });
      
      $('#schedule_datetime').datetimepicker({
          format: 'd-M-Y H:i',
          minDate: 0,
          timepicker: true,
          step: 1,
      });
      
      function currDate() {
  var d = new Date();
  var y = d.getFullYear();
  var m = d.getMonth();
  var da = d.getDate();
  var h = d.getHours();
  var mi = d.getMinutes() + 10;
  var se = d.getSeconds();
  var mDate = new Date(y, m, da, h, mi, se);
  return mDate;
}
      // Assuming you have included the necessary xdsoft_timepicker library

        // Get the current date and time in local time
        // var currentDateTime = moment();

        // Add five minutes to the current time
        // currentDateTime.add(5, 'minutes');

        // Format the date and time in the desired format
        // var formattedDateTime = currentDateTime.format('DD-MMM-YYYY H:i');

        // Display the formatted date and time in the timepicker
        // $('#poll_expiration').datetimepicker({
        //     // value: formattedDateTime,
        //     timeZone: "{{ getUserTimeZone() }}"
        // });

      
    ///// Start Code for comment button ///////// 
//     $(document).on('click', '.post_cmtt', function() {
        
        
//         let input = $(this).closest('.post_cmtt');
//         let postId = input.attr('id');
//         console.log(postId);
//         let button = $(this).closest('.comment_submit_btn');

// button.setAttribute('disabled', true);  // Make disable initially

// input.addEventListener('keyup', function(event){
//     console.log('test');
   
//    let val = event.target.value;  // input's current value
   
//    if(val===''){
//         button.setAttribute('disabled', true);  // Set disabled attribute
//    }
//    else{
//        button.removeAttribute('disabled', false);  // Remove disabled attribute 
//    }
//    });
   
//         //$(this).closest('.d-flex').remove();
//     });

   ///// End Code for comment button ///////// 
   
   $("#select_box").select2({
    minimumResultsForSearch: Infinity
});

  });
</script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> --}}



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js">
</script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/froala_editor.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/align.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/code_beautifier.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/code_view.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/colors.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/draggable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/emoticons.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/font_size.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/font_family.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/image.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/file.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/image_manager.min.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/line_breaker.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/link.min.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/lists.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/paragraph_format.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/paragraph_style.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/video.min.js')}}"></script>
{{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/table.min.js')}}"></script> --}}
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/url.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/entities.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/char_counter.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/inline_style.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/save.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/fullscreen.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/froalaeditor/js/languages/ro.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


<script>
    $(document).ready(function(){
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
            event.preventDefault(); 
            event.stopPropagation(); 
            $(this).parent().siblings().removeClass('open');
            $(this).parent().toggleClass('open');
        });
        });
        
var swiper = new Swiper('.mySwiper-post', {
  slidesPerView: "1",
  spaceBetween: 20,
  grabCursor: true,
//   loop: true,
//     autoplay: {
//         delay: 0,
//     },
//     speed: 11000,          //add
//     slidesPerView: 3,     //add
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
          992: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
          375: {
            slidesPerView: 2,
            spaceBetween: 10,
          },
        },
});


// function convertToUserTimezone(indianDateStr, userTimezone)
// {
//     // Parse the Indian date string into a JavaScript Date object (assuming format: 'dd-mm-yyyy HH:ii:ss')
//     var parts = indianDateStr.split(' ');
//     var dateParts = parts[0].split('-');
//     var timeParts = parts[1].split(':');
    
//     var indianDate = new Date(dateParts[2], dateParts[1] - 1, dateParts[0], timeParts[0], timeParts[1], timeParts[2]);
    
//     // Convert the Indian date to the user's timezone
//     var userDate = new Date(indianDate.toLocaleString('en-US', { timeZone: userTimezone }));
    
//     // Format the user's date as 'yyyy-mm-dd HH:ii:ss'
//     var formattedUserDate = userDate.toISOString().slice(0, 19).replace('T', ' ');
    
//     return formattedUserDate;
// }


// Function to format a date object as "2023-08-14 09:19:37"
// function formatDate(date) {
//     var year = date.getFullYear();
//     var month = ('0' + (date.getMonth() + 1)).slice(-2); // Add 1 to month since it's 0-indexed
//     var day = ('0' + date.getDate()).slice(-2);
//     var hours = ('0' + date.getHours()).slice(-2);
//     var minutes = ('0' + date.getMinutes()).slice(-2);
//     var seconds = ('0' + date.getSeconds()).slice(-2);

//     return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
// }

</script>
<script>
    $(document).ready(function() {
        $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
        });
    });
</script>
@endsection