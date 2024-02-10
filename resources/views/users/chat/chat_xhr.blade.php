    @php $chat_date = ''; @endphp
            @foreach ($chatMemberLists as $msg)
            
            @if ($msg->message != '')
            @if ($msg->from == Auth::user()->id)
                 {{-- $(".msg_card_body").prepend($.tmpl($("#jsSelfTemplate").html(), lstRows)); --}}
                
            <li class="clearfix">
                <div class="message my-message">
                    <div class="d-flex justify-content-end mb-2 chat_box">
                        <div class="msg_container">
                            <div class="d-flex align-items-end gap-2">
                                <p class="mb-0">{{ $msg->message }}</p><span
                                    class="text-sm-10 mb-0">{{ $msg->display_time }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @else
                 {{-- $(".msg_card_body").prepend($.tmpl($("#jsUserTemplate").html(), lstRows)); --}}
            
          
            <li class="clearfix">
                <div class="message other-message">
                    <div
                        class="d-flex justify-content-start mb-2 chat_box gap-2">
                        {{-- <div class="contact-avatar"><img
                                src="{{ ($msg->from_user_profile_url) ? asset('storage/profile/'.$msg->from_user_profile_url) : asset('assets/images/PersonFill.svg') }}" alt="avatar">
                        </div> --}}
                        <div class="msg_container">
                            <div class="d-flex align-items-end gap-2">
                                <p class="mb-0">{{ $msg->message }}</p><span
                                    class="text-sm-10 mb-0 lst_ur_msg_dt">{{ $msg->display_time }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            
            @endif
            @endif
            
            @endforeach
            
            {{-- <li class="clearfix">
                <div class="message my-message">
                    <div class="d-flex justify-content-end mb-2 chat_box">
                        <div class="img_container shadow position-relative"><img
                                class="chat_image"
                                src="{{ asset('assets/images/chat-img-1.jpg') }}" alt=""><span
                                class="text-sm-10 mb-0 position-absolute bottom-0 end-0 mb-2 me-3 text-">12:30
                                pm</span></div>
                    </div>
                </div>
            </li> --}}
        
    