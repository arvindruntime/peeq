@foreach($posts['data'] as $post) 
{{-- {{ dd($post['content']) }} --}}

        @if($post['post_type'] == 'poll_question')
        <div class="lm_post-card lm_card-post my-4">
          <div class="card border-0 px-4 py-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex gap-2 align-items-center">
                {{-- <div class="lm_card-post-logo"><span class="shadow"><img class="in-svg" src="assets/images/logo2.svg" alt=""></span></div> --}}
                <div class="lm_card-post-logo"><span class="shadow p-0"><img class="in-svg rounded-circle object-fit-cover" style="height:100%; width:100%;" src="{{ $post['user']['profile_image_url'] ?? asset('assets/images/logo2.svg') }}" alt=""></span></div>
                <div class="d-lnline text-start">
                  <h5 class="mb-1">{{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}</h5>
                  <p class="mb-0">{{ $post['user']['user_type'] ?? '' }}</p>
                </div>
              </div>
            </div>
            <div class="post_inner-card bg-primary p-2 text-center">
              <h6 class="mb-4">
                {{-- @if($post['post_type']=="post" || $post['post_type']=="article" || $post['post_type']=="poll_question" || $post['post_type']=="poll_multiple_choice" || $post['post_type']=="poll_percentage") --}}
                {!! html_entity_decode($post['content']) !!}
                
            </h6><a class="btn btn--dark-lenear rounded-2" href="#">Share your answer</a>
            </div>
            <div class="post_like-coment d-flex justify-content-between mt-3 align-items-center">
              <div class="d-flex">
                <p class="mb-0 small">
                    Posted {{ $post['created_at']->diffForHumans() }}
                    {{-- Perth, Australia · Posted 4d ago --}}
                </p>
              </div>
              
              <div class="d-flex gap-4">
              <div class="post_comment text-center">
                <a onclick="getActivitiesPosts({{ $post['id'] }},'0','is_save')" class="post-book {{ ($post['is_save']==1) ? "active" : "" }}">
                  
                  @if($post['is_save']==1 && $_GET['type']=='is_save')
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.5 21.3875V21.3881C18.5 21.4015 18.4963 21.4163 18.487 21.4312C18.4776 21.4463 18.462 21.4618 18.4395 21.4733L18.4394 21.4733L18.4339 21.4762C18.4089 21.4895 18.379 21.497 18.3474 21.4965C18.317 21.496 18.2885 21.4882 18.2648 21.4752L11.7557 17.6008L11.5 17.4486L11.2443 17.6008L4.7336 21.4761C4.70727 21.4909 4.67542 21.4997 4.64153 21.4998L4.64153 21.4996L4.62847 21.5C4.61377 21.5004 4.60096 21.4964 4.59205 21.491L4.57661 21.4816L4.56054 21.4733C4.538 21.4618 4.52242 21.4463 4.51298 21.4312C4.50368 21.4163 4.49998 21.4015 4.5 21.3881V21.3875V3.42855C4.5 3.19038 4.59912 2.95672 4.78417 2.78048C4.97004 2.60346 5.22712 2.5 5.5 2.5H17.5C17.7729 2.5 18.03 2.60346 18.2158 2.78048C18.4009 2.95672 18.5 3.19038 18.5 3.42855V21.3875Z" stroke="#7C7F86"/>
                    </svg>
              @else
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.5 21.3875V21.3881C18.5 21.4015 18.4963 21.4163 18.487 21.4312C18.4776 21.4463 18.462 21.4618 18.4395 21.4733L18.4394 21.4733L18.4339 21.4762C18.4089 21.4895 18.379 21.497 18.3474 21.4965C18.317 21.496 18.2885 21.4882 18.2648 21.4752L11.7557 17.6008L11.5 17.4486L11.2443 17.6008L4.7336 21.4761C4.70727 21.4909 4.67542 21.4997 4.64153 21.4998L4.64153 21.4996L4.62847 21.5C4.61377 21.5004 4.60096 21.4964 4.59205 21.491L4.57661 21.4816L4.56054 21.4733C4.538 21.4618 4.52242 21.4463 4.51298 21.4312C4.50368 21.4163 4.49998 21.4015 4.5 21.3881V21.3875V3.42855C4.5 3.19038 4.59912 2.95672 4.78417 2.78048C4.97004 2.60346 5.22712 2.5 5.5 2.5H17.5C17.7729 2.5 18.03 2.60346 18.2158 2.78048C18.4009 2.95672 18.5 3.19038 18.5 3.42855V21.3875Z" stroke="#7C7F86"/>
                </svg>
              @endif 
                </a>                    
                <p class="mb-0 text-sm-10">{{ ($post['is_save']==1 && $_GET['type']=='is_save') ? "Saved" : "Save" }}</p>
              </div> 
            </div>
              
              
            </div>
          </div>
        </div>         
          
        @endif 
        @if($post['post_type']=="post" || $post['post_type']=="article")
        <div class="lm_post-card lm_card-post my-4">
            <div class="card border-0 px-4 py-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <div class="d-flex gap-2 align-items-center">
                  {{-- <div class="lm_card-post-logo"><span class="shadow"><img class="in-svg" src="assets/images/logo2.svg" alt=""></span></div> --}}
                  <div class="lm_card-post-logo"><span class="shadow p-0"><img class="in-svg rounded-circle object-fit-cover" style="height:100%; width:100%;" src="{{ $post['user']['profile_image_url'] ?? asset('assets/images/logo2.svg') }}" alt=""></span></div>
                  <div class="d-lnline">
                      <h5 class="mb-1">{{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}</h5>
                  <p class="mb-0">{{ $post['user']['user_type'] ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="post_inner-card-con">
            <p class="mb-2 more title-font">{!! html_entity_decode($post['content']) !!}</p>
        </div>
            <div class="post_like-coment d-flex justify-content-between mt-3 align-items-center">
                <div class="d-flex">
                    <p class="mb-0 small"> Posted {{ $post['created_at'] }}</p>
                    {{-- ->diffForHumans() --}}
                </div>
                
                @if($_GET['type']=='is_save')
                <div class="d-flex gap-4">
                    <div class="post_comment text-center">
                    <a onclick="getActivitiesPosts({{ $post['id'] }},'0','is_save')" class="post-book {{ ($post['is_save']==1) ? "active" : "" }}">
                        
                      
                        @if($post['is_save']==1)
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 21.3875V21.3881C18.5 21.4015 18.4963 21.4163 18.487 21.4312C18.4776 21.4463 18.462 21.4618 18.4395 21.4733L18.4394 21.4733L18.4339 21.4762C18.4089 21.4895 18.379 21.497 18.3474 21.4965C18.317 21.496 18.2885 21.4882 18.2648 21.4752L11.7557 17.6008L11.5 17.4486L11.2443 17.6008L4.7336 21.4761C4.70727 21.4909 4.67542 21.4997 4.64153 21.4998L4.64153 21.4996L4.62847 21.5C4.61377 21.5004 4.60096 21.4964 4.59205 21.491L4.57661 21.4816L4.56054 21.4733C4.538 21.4618 4.52242 21.4463 4.51298 21.4312C4.50368 21.4163 4.49998 21.4015 4.5 21.3881V21.3875V3.42855C4.5 3.19038 4.59912 2.95672 4.78417 2.78048C4.97004 2.60346 5.22712 2.5 5.5 2.5H17.5C17.7729 2.5 18.03 2.60346 18.2158 2.78048C18.4009 2.95672 18.5 3.19038 18.5 3.42855V21.3875Z" stroke="#7C7F86"/>
                        </svg>
                        @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 21.3875V21.3881C18.5 21.4015 18.4963 21.4163 18.487 21.4312C18.4776 21.4463 18.462 21.4618 18.4395 21.4733L18.4394 21.4733L18.4339 21.4762C18.4089 21.4895 18.379 21.497 18.3474 21.4965C18.317 21.496 18.2885 21.4882 18.2648 21.4752L11.7557 17.6008L11.5 17.4486L11.2443 17.6008L4.7336 21.4761C4.70727 21.4909 4.67542 21.4997 4.64153 21.4998L4.64153 21.4996L4.62847 21.5C4.61377 21.5004 4.60096 21.4964 4.59205 21.491L4.57661 21.4816L4.56054 21.4733C4.538 21.4618 4.52242 21.4463 4.51298 21.4312C4.50368 21.4163 4.49998 21.4015 4.5 21.3881V21.3875V3.42855C4.5 3.19038 4.59912 2.95672 4.78417 2.78048C4.97004 2.60346 5.22712 2.5 5.5 2.5H17.5C17.7729 2.5 18.03 2.60346 18.2158 2.78048C18.4009 2.95672 18.5 3.19038 18.5 3.42855V21.3875Z" stroke="#7C7F86"/>
                        </svg>
                        @endif 
                    </a>                    
                    <p class="mb-0 text-sm-10">{{ ($post['is_save']==1) ? "Saved" : "" }}</p>
                    
                    </div> 
                </div>
                @endif
                
                @if($_GET['type']=='is_hide_post')
                <div class="d-flex gap-4">
                    <div class="post_comment text-center">
                    <a onclick="getActivitiesPosts({{ $post['id'] }},'0','is_hide_post')" class="post-book {{ ($post['is_hide_post']==1) ? "active" : "" }}">
                        
                      
                        {{-- @if($post['is_hide_post']==1)
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 21.3875V21.3881C18.5 21.4015 18.4963 21.4163 18.487 21.4312C18.4776 21.4463 18.462 21.4618 18.4395 21.4733L18.4394 21.4733L18.4339 21.4762C18.4089 21.4895 18.379 21.497 18.3474 21.4965C18.317 21.496 18.2885 21.4882 18.2648 21.4752L11.7557 17.6008L11.5 17.4486L11.2443 17.6008L4.7336 21.4761C4.70727 21.4909 4.67542 21.4997 4.64153 21.4998L4.64153 21.4996L4.62847 21.5C4.61377 21.5004 4.60096 21.4964 4.59205 21.491L4.57661 21.4816L4.56054 21.4733C4.538 21.4618 4.52242 21.4463 4.51298 21.4312C4.50368 21.4163 4.49998 21.4015 4.5 21.3881V21.3875V3.42855C4.5 3.19038 4.59912 2.95672 4.78417 2.78048C4.97004 2.60346 5.22712 2.5 5.5 2.5H17.5C17.7729 2.5 18.03 2.60346 18.2158 2.78048C18.4009 2.95672 18.5 3.19038 18.5 3.42855V21.3875Z" stroke="#7C7F86"/>
                        </svg>
                        @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5 21.3875V21.3881C18.5 21.4015 18.4963 21.4163 18.487 21.4312C18.4776 21.4463 18.462 21.4618 18.4395 21.4733L18.4394 21.4733L18.4339 21.4762C18.4089 21.4895 18.379 21.497 18.3474 21.4965C18.317 21.496 18.2885 21.4882 18.2648 21.4752L11.7557 17.6008L11.5 17.4486L11.2443 17.6008L4.7336 21.4761C4.70727 21.4909 4.67542 21.4997 4.64153 21.4998L4.64153 21.4996L4.62847 21.5C4.61377 21.5004 4.60096 21.4964 4.59205 21.491L4.57661 21.4816L4.56054 21.4733C4.538 21.4618 4.52242 21.4463 4.51298 21.4312C4.50368 21.4163 4.49998 21.4015 4.5 21.3881V21.3875V3.42855C4.5 3.19038 4.59912 2.95672 4.78417 2.78048C4.97004 2.60346 5.22712 2.5 5.5 2.5H17.5C17.7729 2.5 18.03 2.60346 18.2158 2.78048C18.4009 2.95672 18.5 3.19038 18.5 3.42855V21.3875Z" stroke="#7C7F86"/>
                        </svg>
                        @endif  --}}
                                        
                    <p class="mb-0 text-sm-14 btn btn-sm btn--primary py-2 px-1">{{ ($post['is_hide_post']==1) ? "Unhide" : "" }}</p>
                  </a>
                    
                    </div> 
                </div>
                @endif
            </div>
              
        </div>
        </div>
        @endif 
@endforeach

