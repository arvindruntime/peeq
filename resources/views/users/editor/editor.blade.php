<!DOCTYPE html>
    <html>
    <head>
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/froala_editor.css')}}">
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/froala_style.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/code_view.css')}}"> --}}
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/colors.css')}}">
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/emoticons.css')}}">
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/image_manager.css')}}">
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/image.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/line_breaker.css')}}"> --}}
        {{-- <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/table.css')}}"> --}}
        {{-- <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/char_counter.css')}}"> --}}
        <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/video.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/fullscreen.css')}}"> --}}
        {{-- <link rel="stylesheet" href="{{asset('assets/froalaeditor/css/plugins/file.css')}}"> --}}
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css"> --}}
        
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/plugins/video.min.css"> --}}
        
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
        <style>
          /* #postEditor {
  width: 100%;
  overflow-x: auto;
}

@media screen and (max-width: 650px) {
  #postEditor {
    overflow-x: hidden;
  }
} */
        </style>
        
        {{-- <style>
            .fr-box.fr-basic .fr-element {
            height: 100vh !important;
            overflow: scroll;
    }
    
            .editor-container {
            height: 500px; /* Set the desired height */
            margin-left:10px;
            margin-right: 20px;

          }
            #edit {
              min-height: 165px;
              height: 100%;
            }
          
          </style> 
          
          <style>
            .fr-wrapper {
              border: none !important;
              box-shadow: none !important;
            }
          </style>--}}

    </head>
    
    <body class="fr-fullscreen" style="-webkit-overflow-scrolling: touch;overflow-y: scroll;">
      
      @if($_GET['post_type']=='post')
      <div id="postEditor"></div>
      {{-- <div class="editor-container">
        <textarea id='postEditor' placeholder="Share your thoughts..."> </textarea>
      </div> --}}
      @endif
      
      @if($_GET['post_type']=='article')
      {{-- <div id="articleEditor"></div> --}}
      <div class="editor-container">
        <textarea id='articleEditor' placeholder="Share your thoughts..."> </textarea>
      </div> 
      @endif
        
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script> --}}
  {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script> --}}
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/froala_editor.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/align.min.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/code_beautifier.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/code_view.min.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/colors.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/draggable.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/emoticons.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/font_size.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/font_family.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/image.min.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/file.min.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/image_manager.min.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/line_breaker.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/link.min.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/lists.min.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/paragraph_format.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/paragraph_style.min.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/video.min.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/table.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/url.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/entities.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/char_counter.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/inline_style.min.js')}}"></script> --}}
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/save.min.js')}}"></script> --}}
  <script type="text/javascript" src="{{asset('assets/froalaeditor/js/plugins/fullscreen.min.js')}}"></script>
  {{-- <script type="text/javascript" src="{{asset('assets/froalaeditor/js/languages/ro.js')}}"></script> --}}
  
  <script type="text/javascript">
    const froala_editor_key = '{{ config('app.froala_editor_key') }}';
    </script>
          
<script>
  
  $( document ).ready(function() {       
      const editor = new FroalaEditor('#postEditor', {  
        key: froala_editor_key,
        attribution: false,
        charCounterCount: false,
        // fullScreen: true,
        fullPage: true,
        placeholderText: 'Share your thoughts...',
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
        videoUpload: true,
        videoResponsive: true,  
        videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],                   
        imageUploadURL: "{{ route('upload.image') }}",
        imageAllowedTypes: ['jpeg', 'JPEG', 'jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP', 'tiff', 'TIFF', 'ico', 'ICO', 'svg', 'SVG', 'HEIC'],
        imageMaxSize: 50 * 1024 * 1024,        
        videoUploadURL: "{{ route('upload.video') }}",
        videoAllowedTypes: ['avi', 'AVI', 'webm', 'mov', 'HEVC', 'flv', 'FLV', 'mp4','MOV','WMV', 'AVCHD', 'F4V', 'SWF', 'MKV', 'WEBM'],
        videoDefaultWidth: '640',
        videoDefaultHeight: '360',
        videoDefaultAlign: 'center',
        videoMaxSize: 1024 * 1024 * 200,
        videoManagerGridView: {
                                gridWidth: 'auto'
                                , gridMargin: 10
                            },
        requestHeaders: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
        imageInsertButtons: ['imageUpload']                                
    });
    
    
    
    
    const articleEditor = new FroalaEditor('#articleEditor', {  
      key: froala_editor_key,
        attribution: false,
        charCounterCount: false,
        // fullScreen: true,
        fullPage: true,
        placeholderText: 'Share your thoughts...',
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
        videoUpload: true,
        videoResponsive: true,  
        videoInsertButtons: ['videoBack', '|', 'videoUpload', 'videoManager'],                   
        imageUploadURL: "{{ route('upload.image') }}",        
        videoUploadURL: "{{ route('upload.video') }}",
        videoDefaultWidth: '640',
        videoDefaultHeight: '360',
        videoDefaultAlign: 'center',
        videoMaxSize: 1024 * 1024 * 200,
        videoManagerGridView: {
                                gridWidth: 'auto'
                                , gridMargin: 10
                            },
        requestHeaders: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
        imageInsertButtons: ['imageUpload']                             
    });
  
  });
  
  </script>  
  
  @if($_GET['post_type'] =="post")
    <script type="text/javascript">
    function getHtmlCode(){
      const editorHtmlSource = new FroalaEditor('#postEditor', { });
      var htmlcode = editorHtmlSource.html.get();
      console.log('html source code = '+htmlcode);
      window.webkit.messageHandlers.jsMessageHandler.postMessage(htmlcode);
    }
    
    function sendHtmlCode(message){
      const editor = new FroalaEditor('#postEditor', { });
      editor.html.set(message);
      console.log('Update = '+message);
    }
    </script>
  @endif
  
  @if($_GET['post_type'] =="article")
  <script type="text/javascript">
    function getHtmlCode(){
      const editorHtmlSource = new FroalaEditor('#articleEditor', { });
      var htmlcode = editorHtmlSource.html.get();
      console.log('html source code = '+htmlcode);
      window.webkit.messageHandlers.jsMessageHandler.postMessage(htmlcode);
    }
    
    function sendHtmlCode(message){
      const editor = new FroalaEditor('#articleEditor', { });
      editor.html.set(message);
      console.log('Update = '+message);
    }
    </script>
  @endif

    </body>
    </html>