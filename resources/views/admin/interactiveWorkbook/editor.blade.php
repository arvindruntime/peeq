@extends('layouts.admin.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.19/css/froala_editor.pkgd.min.css" />
<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-list-admin">
    <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <form method="post" name="formEditInteractive" id="formEditInteractive" enctype="multipart/form-data">

      <div class="create-list-admin-title">
        {{-- <p class="fs-4 mb-0 text-black">{{$interactiveworkbook->course->course_name}}</p> --}}
        <h4 class="fw-bold text-primary mb-4">How To Get The Most Out Of This Program</h4>
      </div>  
      <div class="row">
        <div class="col-12 col-md-6 mb-4">
          <div class="pdf-editor">
            <p class="fs-4 mb-3 text-black fw-bold">PDF Editor</p>
            <!-- Used froala Editor -->
            <div class="mb-3"> <textarea class="ckplot rounded-3" rows="13" id="pdf_content" name="pdf_content" >{{$interactiveworkbook->pdf_content}}</textarea></div>
          </div>
        </div>
        <div class="col-12 col-md-6  mb-4">
          <div class="interactive-editor">
            <p class="fs-4 mb-3 text-black fw-bold">Interactive Editor</p>
            <!-- Used froala Editor -->
            <div class="mb-3"> <textarea class="ckplot rounded-3" rows="13" id="interactive_content" name="interactive_content">{{$interactiveworkbook->interactive_content}}</textarea></div>
          </div>
        </div>
        {{-- <div class="col-12">
          <div class="audio-interactive ">
            <p class="fs-4 mb-1 mb-sm-0 text-black">Audio Recording</p>
            <p class="mb-3">The Audio Recording is not mandatory.</p>
            <div class="lm__module-add mb-4">
              <div class="lm__module-add-con">
                <div class="lm__module-card p-0">
                  <label class="position-relative thumb">
                    <input class="form-control" id="formFile" type="file" name="audio_file"value="{{ $interactiveworkbook->audio_file}}">
                    <span class="position-absolute top-50 start-50 translate-middle text-dark text-sm-14 text-center title-font text-nowrap">Upload Audio Recording</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
         
          <div class="col-12">
            <div class="lm__module-form">
                @if ($interactiveworkbook->audio_file)
                <audio controls>
                      <source src="{{ $interactiveworkbook->audio_file }}" type="audio/mpeg">
                    <source src="{{ $interactiveworkbook->audio_file }}" type="audio/wav">
                    <source src="{{ $interactiveworkbook->audio_file }}" type="audio/ogg">
                    Your browser does not support the audio element.
                </audio>
                @endif
            </div>
        </div>
        </div> --}}
        
        <div class="col-12 my-3 text-center">
          {{-- <a class="btn btn--primary py-2 px-5" href="">Save</a> --}}
          {{-- <a class="btn btn--primary py-2 px-5" href="#">Save</a> --}}
          <button class="btn btn--primary py-2 px-5" id="UpdateBtnInteractive" type="button">Save</button>
        </div>
      </div>
    </form>

    </div>
  </section>
</main>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/4.0.19/js/froala_editor.pkgd.min.js"></script>
<script>
  $(document).ready(function() {
    
    var pdfContentEditor = new FroalaEditor('#pdf_content', {
                            key: froala_editor_key,
                            attribution: false,
                            placeholderText: 'PDF content...',
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
                                //buttons: ['insertImage', 'insertVideo', 'emoticons', 'fontAwesome', 'specialCharacters', 'html']
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
                            ,videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4','MOV']
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
                            }
                        });
                        
                        
                        var interactiveContentEditor = new FroalaEditor('#interactive_content', {
                            key: froala_editor_key,
                            attribution: false,
                            placeholderText: 'Interactive content...',
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
                                //buttons: ['insertImage', 'insertVideo', 'emoticons', 'fontAwesome', 'specialCharacters', 'html']
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
                            ,videoAllowedTypes: ['avi', 'webm', 'mov', 'HEVC', 'flv', 'mp4','MOV']
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
                
                            }
                        });
    
      $('#UpdateBtnInteractive').click(function(e) {
          e.preventDefault();
          // var formData  = $("#contact-support").serialize()         
          let _token = $("input[name=_token]").val();

          let url = '{{ route("interactive.workbook.update", ":id") }}';
          url = url.replace(':id', {{$interactiveworkbook->id}});

          var formData = new FormData($("#formEditInteractive")[0]);
        //   formData.set('page_no', '2')
        //   formData.set('status', '1')

          $.ajax({
              url: url,
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
                  console.log(data);
                  if (data.error) {
                      printErrorMsg(data.error);
                      return false;
                  } else if (data.status == "200") {
                      $('#errorField').text('');
                      $("#formEditInteractive")[0].reset();
                      var success_message = data.message;
                      console.log(success_message);
                      Swal.fire({
                          toast: true,
                          icon: 'success',
                          title: success_message,
                          position: 'top-right',
                          showConfirmButton: false,
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal
                                  .stopTimer);
                              toast.addEventListener('mouseleave', Swal
                                  .resumeTimer);
                          }
                      });
                      
                      id = data.data.course_module_id;
                      var url = "{{route('admin.interactive.list.workbook', ":id")}}";
                      url = url.replace(":id", id);
                      window.location.href = url;
                    
                  }
              },
              error: function(xhr, status, error) {

                  var errorMessage =
                  "An error occurred. Please try again."; // Default error message
                  if (xhr.responseJSON && xhr.responseJSON.message) {
                      // console.log(xhr.responseJSON);
                      errorMessage = xhr.responseJSON
                      .message; // Use the error message from the API response
                      Swal.fire({
                          toast: true,
                          icon: 'success',
                          title: errorMessage,
                          position: 'top-right',
                          showConfirmButton: false,
                          timer: 2000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                              toast.addEventListener('mouseenter', Swal
                                  .stopTimer);
                              toast.addEventListener('mouseleave', Swal
                                  .resumeTimer);
                          }
                      });
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
  });
</script>
@endsection