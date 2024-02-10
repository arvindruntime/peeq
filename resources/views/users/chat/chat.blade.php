@extends('layouts.admin.master')
@section('content')
<style>
    .bg-danger {
  background-color: #dc3545 !important;
  
}
.lm__chat-footer .emoji-picker-icon{
    position: absolute;
    right: 125px !important;
    top: 13px !important;
    left: auto;
    z-index: 99 !important;
}

.emoji-wysiwyg-editor.form-control{
    border: 0  
}
</style>

<style type="text/css">
.contacts_body .contact-avatar{
    position: relative;
    overflow: visible
}

.contacts_body .contact-avatar img{
    position: relative;
    overflow: hidden;
    border-radius: 40px;
    object-fit: cover;
}

.status-circle {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: grey;
    border: 2px solid white;
    bottom: 0px;
    right: -4px;
    position: absolute;
}
.status-circle.di__user_status--live {
    background-color: #4cd137;
}</style>
    <main class="main-content" id="main">
        <section class="lm__dash-con lm__chat-con"><span class="lm_vec"><img class="light" src="{{ asset('assets/images/light.png') }}"
                    alt=""><img class="dark" src="{{ asset('assets/images/dark.png') }}" alt=""></span>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="lm__chat card shadow border-0">
                            <div class="d-flex">
                                <div class="lm__chat-list">
                                    <div class="d-flex lm__chat-title justify-content-between">
                                        <h5 class="fw-bold">Chats</h5>
                                        {{-- <span>
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal19"> <img class="in-svg"
                                                    src="{{ asset('assets/images/plus-add.svg') }}" alt=""></a>
                                        </span> --}}
                                    </div>
                                    <div class="chat_header">
                                        <form action="#" role="search">
                                            <div class="lm__dash-search"><input class="form-control shadow"
                                                    id="lm-search" type="search" aria-label="Search"
                                                    placeholder="Search"><button type="submit"><span> <img
                                                            class="in-svg" src="{{ asset('assets/images/search.svg') }}"
                                                            alt=""></span></button></div>
                                        </form>
                                    </div>
                                    <div class="contacts_body">
                                        <ul class="contacts" id="contact-list">
                                            {{-- <li class="chat-group d-flex justify-content-between" id="contact-list-1">
                                                <div class="d-flex gap-2 gap-lg-3">
                                                    <div class="contact-avatar"><img src="{{ asset('assets/images/avtar-19.jpg') }}"
                                                            alt="avatar"></div>
                                                    <div class="contacts__about">
                                                        <div class="contact__name">
                                                            <p>Group Name</p>
                                                        </div>
                                                        <div class="contact__msg">
                                                            <p>How are you?</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="chat-count"><span class="d-block date">03:41PM</span><span
                                                        class="badge rounded-circle">2</span></div>
                                            </li> --}}
                                            
                                            
                                                @include('users.chat.chat_members_xhr')
                                                <span class="d-none no_records_found">
                                                    <li class="active"><div class="text-center bd-highlight" style="color: white">{{ __('No Record Found') }}</div></li>
                                                </span>
                                            
            
                                        </ul>
                                    </div>
                                </div>
                                <div class="lm__chat-main card border-0">
                                    <div class="lm__chat-header p-3 msg_head">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2 gap-lg-3 align-items-center">
                                                <div class="toggle__menu chat_list">
                                                    <span>
                                                        <img class="in-svg" src="{{ asset('assets/images/backto.svg') }}" alt="">
                                                    </span>
                                                </div>
                                                <div class="contact-avatar shadow">
                                                    <img id="chat_user_profile" src="{{ asset('assets/images/PersonFill.svg') }}"  alt="Avatar">
                                                </div>
                                                <div class="contacts__about">
                                                    <div class="contact__name">
                                                        <p id="chat_user_name"></p>
                                                    </div>
                                                    <div class="contact__msg">
                                                        <p>
                                                            {{-- Last seen 3 hours ago --}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="dropdown"><a href="#" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><span> <img
                                                                class="in-svg" src="{{ asset('assets/images/chat-dots.svg') }}"
                                                                alt=""></span></a>
                                                    <div class="dropdown-menu lm_drop border-0 shadow mt-3 rounded-4">
                                                        <ul>
                                                            <li> <a class="dropdown-item" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal17">Block Arlene</a>
                                                            </li>
                                                            <li> <a class="dropdown-item" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#exampleModal18">Report Arlene</a>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown-card dropdown-item">
                                                                    <div class="form-check form-switch ps-0 mb-2">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <label class="form-check-label title-font"
                                                                                for="flexSwitchCheckChecked">Mute</label><input
                                                                                class="form-check-input"
                                                                                id="flexSwitchCheckChecked"
                                                                                type="checkbox" role="switch"></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <p class="text-light-emphasis text-sm mb-0 title-font">
                                                                    Manage </p>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown-card dropdown-item">
                                                                    <div class="form-check form-switch ps-0 mb-2">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <label class="form-check-label title-font"
                                                                                for="flexSwitchCheckChecked">Enable
                                                                                Sounds</label><input
                                                                                class="form-check-input"
                                                                                id="flexSwitchCheckChecked"
                                                                                type="checkbox" role="switch"
                                                                                checked=""></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="dropdown-card dropdown-item">
                                                                    <div class="form-check form-switch ps-0 mb-2">
                                                                        <div
                                                                            class="d-flex justify-content-between align-items-center">
                                                                            <label class="form-check-label title-font"
                                                                                for="flexSwitchCheckChecked">Show Send
                                                                                Button</label><input
                                                                                class="form-check-input"
                                                                                id="flexSwitchCheckChecked"
                                                                                type="checkbox" role="switch"></div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li> <a class="dropdown-item" type="button"
                                                                    data-bs-toggle="offcanvas"
                                                                    data-bs-target="#offcanvasRight3"
                                                                    aria-controls="offcanvasRight3">Notification
                                                                    Settings</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <div class="lm__chat-body card-body">
                                <div class="chat-history-main">
                                    <div class="chat-history">
                                        {{-- <div class="d-flex justify-content-center">
                                            <p class="mb-2 lst_ur_msg_dt">Today </p>
                                        </div> --}}
                                        <ul class="msg_card_body" id="msg_card_body">
                                        @include('users.chat.chat_xhr')
                                              
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                        <div class="lm__chat-footer card-footer border-0 p-0">
                                            <div class="input-group mb-0 shadow smile-icon">
                                                {{-- <span class="position-absolute top-50 start-0 translate-middle-y ms-2" id="emojiIcon">
                                                    <img class="in-svg" src="{{ asset('assets/images/emoji.svg') }}" alt="">
                                                </span> --}}
                                                
                                                
                    
                    
                                                        
                                                        <input data-emojiable="true"  class="form-control me-2" id="message"
                                                    type="text" placeholder="Type a message here..."
                                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                                    
                                                    {{-- <textarea data-emojiable="true"  class="form-control me-2" id="message" placeholder="Type a message here..."
                                                    aria-label="Recipient's username" aria-describedby="button-addon2"></textarea> --}}
                                                    
                                                <div class="d-flex gap-4 align-items-center">
                                                    {{-- <br><br><br><br> --}}
                                                    
                                                    {{-- <div class="chat_file-img"> <label class="input-group-text p-0"
                                                            for="inputGroupFile01"><input class="form-control"
                                                                id="inputGroupFile01" type="file"><img class="in-svg"
                                                                src="{{ asset('assets/images/imageupd.svg') }}" alt=""></label></div> --}}
                                                                
                                                    <div class="chat_file-img chat_file-link"> 
                                                        <label class="input-group-text p-0" for="imageUpload">
                                                            <input type="file" id="imageUpload" class="form-control" multiple="">
                                                            <img class="in-svg" src="{{ asset('assets/images/link-1.svg') }}" alt="">
                                                        </label>
                                                    </div>
                                                    <button class="btn btn-send btn--primary send_btn" id="button-addon2"
                                                        type="button">
                                                         <img class="in-svg" src="{{ asset('assets/images/plane.svg') }}"
                                                            alt="">
                                                    </button>
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
        
    <script id="jsUserTemplate" type="text/x-jQuery-tmpl">
        <div class="d-flex justify-content-start mb-4 chat_box">
            <div class="img_cont_msg">
                <img src="${profile_photo_path}" class="rounded-circle user_img_msg">
            </div>
            <div class="msg_cotainer">
                <p>${message}</p>
            </div>
            <div class="send_msg_time">
                <span class="msg_time">${time}</span>
            </div>
        </div>
    </script>

    <script id="jsSelfTemplate" type="text/x-jQuery-tmpl">
        <div class="d-flex justify-content-end mb-4 chat_box">
            
            <div class="msg_container">
                <div class="d-flex align-items-end gap-2">
                    <p class="mb-0">${message}</p>
                    <span class="text-sm-10 mb-0">${time}</span>
                </div>
            </div>

        </div>
    </script>
    
    
    <script type="text/javascript" src="{{ asset('assets/js/jquery.tmpl.js') }}"></script>
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
<script src="https://cdn.socket.io/4.1.1/socket.io.min.js" integrity="sha384-cdrFIqe3RasCMNE0jeFG9xJHog/tgOVC1E9Lzve8LQN1g5WUHo0Kvk1mawWjxX7a" crossorigin="anonymous"></script>
<script>
    const all_users = @json($users);
    const users = @json($users);
    console.log(users);
    const from_user = @json(Auth::user());
    const chat_user_route = "{{ route('chat.message', ':id') }}";
    const encode_string_url = "{{ route('chat.encodestring') }}";
    const decode_string_url = "{{ route('chat.decodestring') }}";
    const today = new moment();
    const just_now_message =  today.format("HH:mm");
    // const socket_host = "{{ env('CHAT_HOST'  ) }}:{{ env('CHAT_PORT') }}";
    const csrf_token = "{{ csrf_token() }}";
    const chat_store_media = "{{ route('chat.storeMedia') }}";
</script>
<script src="{{ asset('assets/js/chat-socket.js') }}"></script>


{{-- /// Emoji code start --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.2/darkly/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link href="{{ asset('assets/emoji/css/emoji.css')}}" rel="stylesheet">

{{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}

<!-- Begin emoji-picker -->
<!-- Begin emoji-picker JavaScript -->
<script src="{{ asset('assets/emoji/js/config.min.js')}}"></script>
<script src="{{ asset('assets/emoji/js/util.min.js')}}"></script>
<script src="{{ asset('assets/emoji/js/jquery.emojiarea.min.js')}}"></script>
<script src="{{ asset('assets/emoji/js/emoji-picker.min.js')}}"></script>
<!-- End emoji-picker JavaScript -->


{{-- <script>
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

        // Add click event listener to emoji icon
        $('#emojiIcon').on('click', function() {
            // Trigger the emoji picker to open
            window.emojiPicker.togglePicker(this);
        });
    });
</script> --}}


<script>
    var assetsPath = "{{ asset('assets/emoji/img/')}}";
    $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: assetsPath,
        popupButtonClasses: 'fa fa-smile-o'
      });
      window.emojiPicker.discover();
    });
</script>
<!-- End emoji-picker --> 
@endsection