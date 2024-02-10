{{-- {{ dd($users) }}                                  --}}
@foreach ($users as $k=>$member)   
    <li class="chat-group d-flex justify-content-between chat-user {{ $k == 0 ? 'active' : '' }}" id="chat-user-{{ $member->id }}" chat-user="{{ $member->id }}" data-user="{{ $member->id }}">
        <div class="d-flex gap-2 gap-lg-3">
            <div class="contact-avatar shadow"><img src="{{ $member->profile_image ? $member->profile_image : asset('assets/images/PersonFill.svg') }}"
                    alt="avatar">
                    <div class="status-circle"></div>
                </div>
            <div class="contacts__about">
                <div class="contact__name">
                    <p>{{ $member->name }}</p>
                </div>
                <div class="contact__msg">
                    <p class="user_last_msg">{{ ($member->last_message->message) ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="chat-count">
            <span class="d-block date">{{ $member->created_at }}</span>
            {{-- @php
                if($member->message_count==0 || $member->message_count=='')
                {
                    $badgeRoundedCircle = 'badge rounded-circle msg_count';
                    $member->message_count = '';
                }
                else {
                    $badgeRoundedCircle = 'badge rounded-circle';
                }
            @endphp --}}
            {{-- <span class="{{ $badgeRoundedCircle }} msg_count" id="user_msg_{{ $member->id }}">{{ $member->message_count ?? '' }}</span> --}}
            <span class="badge rounded-circle msg_count" id="user_msg_{{ $member->id }}">{{ $member->message_count ?? '' }}</span>
        </div>
    </li>                                 
@endforeach