{{-- {{ dd($post)}} --}}
{{-- // Row per page --}}
<style>
 .post_cmtt{
  text-align: left;
  }
</style>
@php 
//  $rowperpage = $posts['per_page_records'];
//  $allcount = $posts['total_records'];
//  $rowperpage = $posts['total_pages'];
  @endphp
  
  {{-- <input type="hidden" id="start" value="0"> --}}
  {{-- <input type="hidden" id="rowperpage" value="{{ $rowperpage }}"> --}}
  {{-- <input type="hidden" id="totalrecords" value="{{ $allcount }}"> --}}
  
  <input type="hidden" id="post_id">
  <input type="hidden" id="param">
  <input type="hidden" id="type">
  <input type="hidden" id="modalId">
            
  
          <div class="">
            {{-- lm_post-card lm_card-post my-4 --}}
            <div class="card border-0 px-4 py-4">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex gap-2 align-items-center">
                  <div class="lm_card-post-logo"><span class="shadow p-0"><img class="in-svg rounded-circle object-fit-cover" style="height:100%; width:100%;" src="{{ $post['user']['profile_image_url'] ?? asset('assets/images/logo2.svg') }}" alt=""></span></div>
                  <div class="d-lnline text-start">
                    <h5 class="mb-1">{{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}</h5>
                  
                    <p class="mb-0">{{ $post['user']['user_type'] ?? '' }}</p>
                  </div>
                </div>
                {{-- Post activities dropdown --}}

                {{-- <div class="dropdown">
                  <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span><svg width="7" height="28" viewBox="0 0 7 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.60022 6.79999C5.47799 6.79999 7.00024 5.27776 7.00024 3.39999C7.00024 1.52223 5.47799 0 3.60022 0C1.72245 0 0.200195 1.52223 0.200195 3.39999C0.200195 5.27776 1.72245 6.79999 3.60022 6.79999Z" fill="url(#paint0_linear_1996_5890)"/>
                  <path d="M3.60022 17.4016C5.47799 17.4016 7.00024 15.8793 7.00024 14.0016C7.00024 12.1238 5.47799 10.6016 3.60022 10.6016C1.72245 10.6016 0.200195 12.1238 0.200195 14.0016C0.200195 15.8793 1.72245 17.4016 3.60022 17.4016Z" fill="url(#paint1_linear_1996_5890)"/>
                  <path d="M3.60022 27.9992C5.47799 27.9992 7.00024 26.477 7.00024 24.5992C7.00024 22.7215 5.47799 21.1992 3.60022 21.1992C1.72245 21.1992 0.200195 22.7215 0.200195 24.5992C0.200195 26.477 1.72245 27.9992 3.60022 27.9992Z" fill="url(#paint2_linear_1996_5890)"/>
                  <defs>
                  <linearGradient id="paint0_linear_1996_5890" x1="0.225295" y1="3.37349" x2="6.93364" y2="3.37349" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#0E3049"/>
                  <stop offset="1" stop-color="#01152B"/>
                  </linearGradient>
                  <linearGradient id="paint1_linear_1996_5890" x1="0.225295" y1="13.9799" x2="6.93364" y2="13.9799" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#0E3049"/>
                  <stop offset="1" stop-color="#01152B"/>
                  </linearGradient>
                  <linearGradient id="paint2_linear_1996_5890" x1="0.225295" y1="24.5822" x2="6.93364" y2="24.5822" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#0E3049"/>
                  <stop offset="1" stop-color="#01152B"/>
                  </linearGradient>
                  </defs>
                  </svg>
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a class="dropdown-item" onclick="postAction({{ $post['id'] }},{{ ($post['is_save']==0) ? 1 : 0  }},'is_save')" data-id-save="{{$post['id']}}" >{{ ($post['is_save']==0) ? 'Save Post' : 'Unsave Post'  }}</a>
                      <input type="hidden" id="save_type" value="1"/>
                      <input type="hidden" id="user_id" value="{{ $post['user']['id'] }}"/>
                    </li>
                    <li><a onclick="OpenConfirmModal({{ $post['id'] }},{{ ($post['is_mute']==0) ? 1 : 0  }},'is_mute','#exampleModal9')" class="dropdown-item" type="button">Mute Post</a></li>
                    <li class="dropdown dropdown-submenu"><a class="dropdown-item" data-toggle="dropdown">Share</a>
                      <ul class="dropdown-menu">
                        <li class="d-flex"><a class="dropdown-item w-auto"><span class="icon-md"><img class="in-svg" src="{{ asset('assets/images/mail-to.svg') }}" alt=""></span></a><a class="dropdown-item w-auto"><span class="icon-md" onclick="getPostdetail({{ $post['id'] }})"><img class="in-svg" src="{{ asset('assets/images/link-to.svg') }}" alt=""></span></a></li>
                      </ul>
                    </li>
                    @if($post['user']['id'] != Auth::user()->id)
                    <li class="dropdown dropdown-submenu toggler"><a class="dropdown-item" onclick="addOpenClass()" data-toggle="dropdown">More</a>
                      <ul class="dropdown-menu dropdown-menu-inner">
                        <li><a onclick="OpenConfirmModal({{ $post['id'] }},{{ ($post['is_report']==0) ? 1 : 0  }},'is_report','#exampleModal11')" class="dropdown-item" type="button">Report</a></li>
                        <li><a onclick="OpenConfirmModal({{ $post['id'] }},{{ ($post['is_block_member']==0) ? 1 : 0  }},'is_block_member','#blockMemberModal')" class="dropdown-item" type="button">Block Member</a></li>
                        <li><a onclick="OpenConfirmModal({{ $post['id'] }},{{ ($post['is_report_member']==0) ? 1 : 0  }},'is_report_member','#reportPostMemberModal')" class="dropdown-item" type="button">Report Member</a></li>
                        <li><a onclick="OpenConfirmModal({{ $post['id'] }},{{ ($post['is_hide_post']==0) ? 1 : 0  }},'is_hide_post','#hidePostModal')" class="dropdown-item" type="button">Hide Post</a></li>
                      </ul>
                    </li>
                    @endif
                    
                    @if($post['user']['id'] == Auth::user()->id)
                    
                    <li class="divider"></li>
                    <li class="px-3">
                      <p class="text-light-emphasis text-sm mb-0">Manage</p>
                    </li>
                    <li><a class="dropdown-item" post_type="{{$post['post_type']}}" data-id="{{$post['id']}}"  id="modal_popup">Edit Post</a></li>
                    <li><a class="dropdown-item delete-item" onclick="GetDeletModal({{$post['id']}})">Delete Post</a></li>
                    @endif
                  </ul>
                </div> --}}
              </div>
              @if($post['post_type']=="post" || $post['post_type']=="article")
              <div class="post_inner-card-con">
                <p class="mb-2 more title-font">{!! html_entity_decode($post['content']) !!}</p>
                
                
                
              
              
              </div>
              @endif
              @if($post['post_type']=="poll_question")
              {{-- start Poll question --}}
              <div class="post_inner-card bg-primary p-2 text-center">
                <h6 class="mb-4">{!! $post['content'] !!}</h6><a class="btn btn--dark-lenear rounded-2" href="#">Share your answer</a>
              </div>
              @endif
              
              @if($post['post_type']=="poll_multiple_choice")
              {{-- start Poll multiple --}}
              
              {{-- {{ dd($post['poll_options']) }} --}}
              
              <div class="post_inner-card bg-primary p-2 text-center">
                <h6 class="mb-4">{!! $post['content'] !!}</h6>
                
                {{-- {{ dd($post) }} --}}
                <div class="post_options rounded-3">
                  
                  @if($post['poll_options'])
                    @foreach($post['poll_options'] as $key => $option)
                      <div class="d-block lm__form-input radio mb-2">
                          <div class="form-check d-flex gap-2"><input class="form-check-input"
                                  id="flexRadioDefault1" type="radio" name="flexRadioDefault"><label
                                  class="form-check-label d-block w-100" for="flexRadioDefault1">
                                  <div class="d-flex w-100 justify-content-between">
                                      <p class="title-font h6 mb-0">{{ $option['option']}}</p>
                                      <p class="title-font h6 mb-0">10</p>
                                  </div>
                              </label></div>
                      </div>
                      @endforeach
                    @endif
                </div>
            </div>
              
              @endif
              
              @if($post['post_type']=="poll_percentage")
              {{-- start Poll percentage --}}
              <div class="post_inner-card bg-primary p-2 text-center">
                <h6 class="mb-4">{!! html_entity_decode($post['content']) !!}</h6>
                <div class="post_percentage rounded-3">
                    <div class="d-block lm__form-input radio mb-2">
                        <div class="form-check d-flex gap-2 mb-2"><input class="form-check-input"
                                id="flexRadioDefault5" type="radio" name="flexRadioDefault1"
                                checked><label class="form-check-label d-block w-100"
                                for="flexRadioDefault5">
                                <div class="d-flex w-100 justify-content-between">
                                    <p class="title-font h6 mb-0">Yes</p>
                                    <p class="title-font h6 mb-0">10%</p>
                                </div>
                            </label></div>
                        <div class="lm__form-input">
                            <div class="progress">
                                <div class="progress-bar rounded-3" role="progressbar"
                                    aria-label="Basic example" style="width: 10%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-block lm__form-input radio mb-2">
                        <div class="form-check d-flex gap-2 mb-2"><input class="form-check-input"
                                id="flexRadioDefault6" type="radio" name="flexRadioDefault1"><label
                                class="form-check-label d-block w-100" for="flexRadioDefault6">
                                <div class="d-flex w-100 justify-content-between">
                                    <p class="title-font h6 mb-0">No</p>
                                    <p class="title-font h6 mb-0">90%</p>
                                </div>
                            </label></div>
                        <div class="lm__form-input">
                            <div class="progress">
                                <div class="progress-bar rounded-3" role="progressbar"
                                    aria-label="Basic example" style="width: 90%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              
              @endif
              
              {{-- post like comment save buutton show --}}

              <div class="post_like-coment d-flex justify-content-between mt-3 align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    @if(isset($post['post_activity']) && $post['count_is_like']>0)
                      <div class="avtar-group justify-content-center">
                        <div class="event_attended_avatar d-flex likedByUserPhoto{{ $post['id'] }}">
                          
                          @foreach ($post['post_activity'] as $recentLiked)
                            <div class="avtar-25 shadow bg-white">
                              <img src="{{ $recentLiked['user']['profile_image_url'] }}" alt="{{ $recentLiked['user']['first_name']. ' '.$recentLiked['user']['last_name'] }}" title="{{ $recentLiked['user']['first_name']. ' '.$recentLiked['user']['last_name'] }}">
                            </div>
                          @endforeach
                        </div>
                      </div>
                  @else
                      <div class="avtar-group justify-content-center">
                        <div class="event_attended_avatar d-flex likedByUserPhoto{{ $post['id'] }}">
                          
                        </div>
                      </div>
                      {{-- {{ dd($post['post_activity']) }} --}}
                  @endif
                  @if(isset($post['post_activity']) && $post['count_is_like']>0)
                      <p class="mb-0 small likedByNameCount{{ $post['id'] }}"> Liked by {{ $post['post_activity'][0]['user']['first_name']. ' '.$post['post_activity'][0]['user']['last_name'] }}  and {{ ($post['count_is_like']-1) }} others </p>
                  @else
                  <p class="mb-0 small likedByNameCount{{ $post['id'] }}"></p>
                  @endif
                </div>
                {{-- <div class="d-flex">
                  <p class="mb-0 small"> Posted {{ $post['created_at'] }} </p>
                </div> --}}
                <div class="d-flex gap-4">
                  <div class="post_like text-center">
                    
                    <a onclick="postAction({{ $post['id'] }},{{ ($post['is_like']==0) ? 1 : 0  }},'is_like',1)" isLikeAction="{{ ($post['is_like']==0) ? 1 : 0  }}" isLike="{{ $post['is_like'] }}" postLikeCount="{{ $post['count_is_like'] }}" class="post-like{{ $post['id'] }} p-0 like-svg post-like {{ ($post['is_like']==1) ? "active" : "" }}" data-bs-toggle="tooltip" data-bs-original-title="Acknowledge">
                    
                      @if($post['is_like']==1)
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3047 0.547471C16.293 0.598146 19.5107 3.84717 19.5107 7.84756C19.5107 10.7387 17.83 13.2384 15.3902 14.4209C15.0858 14.5687 14.8951 14.8769 14.8951 15.2119V16.0714H9.52451V15.2119C9.52451 14.88 9.33703 14.57 9.03053 14.4216C6.58452 13.2362 4.90145 10.7273 4.90921 7.82739C4.92004 3.78402 8.26105 0.495988 12.3047 0.547471Z" stroke="#7C7F86"/>
                        <path d="M15.2 22.5345C15.2 23.234 14.5286 23.8008 13.7 23.8008H10.7001C9.87163 23.8008 9.19995 23.2339 9.19995 22.5345V21.8008H15.2V22.5345Z" fill="#7C7F86"/>
                        <path d="M14.0565 8.64453C13.317 8.64453 12.7154 9.2624 12.7154 10.0219V10.5407H11.705V10.0219C11.705 9.2624 11.1037 8.64453 10.3642 8.64453C9.62472 8.64453 9.02344 9.2624 9.02344 10.0219C9.02344 10.7812 9.62501 11.3991 10.3642 11.3991H10.8693V15.7103C10.8687 15.7672 10.879 15.8234 10.8997 15.8761C10.9204 15.9287 10.9512 15.9767 10.99 16.017C11.0289 16.0574 11.0751 16.0895 11.1262 16.1114C11.1772 16.1332 11.232 16.1445 11.2872 16.1445C11.3425 16.1445 11.3973 16.1332 11.4482 16.1114C11.4993 16.0895 11.5455 16.0574 11.5845 16.017C11.6233 15.9767 11.6539 15.9287 11.6747 15.8761C11.6954 15.8234 11.7058 15.7672 11.7051 15.7103V11.3991H12.7154V15.7103C12.7155 15.8242 12.7595 15.9333 12.8379 16.0139C12.9162 16.0943 13.0226 16.1396 13.1334 16.1396C13.2443 16.1396 13.3505 16.0943 13.429 16.0139C13.5073 15.9333 13.5514 15.8242 13.5514 15.7103V11.3991H14.0565C14.7959 11.3991 15.3973 10.7812 15.3973 10.0219C15.3973 9.2624 14.7957 8.64453 14.0565 8.64453ZM10.3642 10.5406C10.0856 10.5406 9.85894 10.308 9.85894 10.0219C9.85894 9.7358 10.0857 9.50297 10.3642 9.50297C10.6426 9.50297 10.8693 9.7358 10.8693 10.0219V10.5407L10.3642 10.5406ZM14.0565 10.5406H13.5515V10.0219C13.5515 9.7358 13.7779 9.50297 14.0566 9.50297C14.3351 9.50297 14.5615 9.7358 14.5615 10.0219C14.5615 10.308 14.3351 10.5406 14.0565 10.5406Z" fill="#7C7F86"/>
                        <path d="M8.97887 18.3358H15.4403C15.6712 18.3358 15.8582 18.1486 15.8582 17.9178C15.8582 17.6871 15.6712 17.5 15.4403 17.5H8.97887C8.92358 17.4994 8.86872 17.5097 8.81747 17.5305C8.76621 17.5512 8.71957 17.5818 8.68025 17.6207C8.64094 17.6596 8.60973 17.7059 8.58842 17.7569C8.56713 17.8079 8.55615 17.8626 8.55615 17.918C8.55615 17.9733 8.56713 18.0279 8.58842 18.079C8.60973 18.13 8.64094 18.1763 8.68025 18.2151C8.71957 18.254 8.76621 18.2847 8.81747 18.3054C8.86872 18.3262 8.92358 18.3364 8.97887 18.3358ZM15.4403 20.2692H8.97887C8.92358 20.2686 8.86872 20.2789 8.81747 20.2996C8.76621 20.3204 8.71957 20.351 8.68025 20.39C8.64094 20.4288 8.60973 20.475 8.58842 20.5261C8.56713 20.5772 8.55615 20.6318 8.55615 20.6871C8.55615 20.7424 8.56713 20.7972 8.58842 20.8481C8.60973 20.8992 8.64094 20.9454 8.68025 20.9843C8.71957 21.0232 8.76621 21.0539 8.81747 21.0746C8.86872 21.0953 8.92358 21.1057 8.97887 21.105H15.4403C15.4955 21.1057 15.5503 21.0953 15.6016 21.0746C15.6529 21.0539 15.6995 21.0232 15.7389 20.9843C15.7781 20.9454 15.8093 20.8992 15.8307 20.8481C15.852 20.7972 15.8629 20.7424 15.8629 20.6871C15.8629 20.6318 15.852 20.5772 15.8307 20.5261C15.8093 20.475 15.7781 20.4288 15.7389 20.39C15.6995 20.351 15.6529 20.3204 15.6016 20.2996C15.5503 20.2789 15.4955 20.2686 15.4403 20.2692ZM15.4403 18.8846H8.97887C8.92358 18.884 8.86872 18.8943 8.81747 18.915C8.76621 18.9358 8.71957 18.9664 8.68025 19.0054C8.64094 19.0442 8.60973 19.0905 8.58842 19.1415C8.56713 19.1925 8.55615 19.2472 8.55615 19.3025C8.55615 19.3578 8.56713 19.4125 8.58842 19.4636C8.60973 19.5146 8.64094 19.5609 8.68025 19.5997C8.71957 19.6386 8.76621 19.6693 8.81747 19.69C8.86872 19.7108 8.92358 19.721 8.97887 19.7205H15.4403C15.4951 19.7205 15.5495 19.7097 15.6002 19.6887C15.6508 19.6677 15.697 19.6369 15.7358 19.5981C15.7745 19.5593 15.8054 19.5132 15.8263 19.4626C15.8474 19.4118 15.8582 19.3575 15.8582 19.3026C15.8582 19.1918 15.8141 19.0854 15.7358 19.007C15.6574 18.9287 15.5511 18.8846 15.4403 18.8846Z" fill="#7C7F86"/>
                        <path d="M15.8685 15.8008H8.48366C8.374 15.8026 8.26944 15.8474 8.19253 15.9256C8.11562 16.0038 8.07251 16.109 8.07251 16.2187C8.07251 16.3284 8.11562 16.4336 8.19253 16.5118C8.26944 16.59 8.374 16.6348 8.48366 16.6366H15.8683C15.9783 16.6353 16.0833 16.5908 16.1607 16.5126C16.2381 16.4344 16.2815 16.3288 16.2815 16.2188C16.2815 16.1088 16.2382 16.0032 16.1609 15.9249C16.0835 15.8467 15.9785 15.8021 15.8685 15.8008V15.8008Z" fill="#7C7F86"/>
                        </svg>
                      @else
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3047 0.547471C16.293 0.598146 19.5107 3.84717 19.5107 7.84756C19.5107 10.7387 17.83 13.2384 15.3902 14.4209C15.0858 14.5687 14.8951 14.8769 14.8951 15.2119V16.0714H9.52451V15.2119C9.52451 14.88 9.33703 14.57 9.03053 14.4216C6.58452 13.2362 4.90145 10.7273 4.90921 7.82739C4.92004 3.78402 8.26105 0.495988 12.3047 0.547471Z" stroke="#7C7F86"/>
                        <path d="M15.2 22.5345C15.2 23.234 14.5286 23.8008 13.7 23.8008H10.7001C9.87163 23.8008 9.19995 23.2339 9.19995 22.5345V21.8008H15.2V22.5345Z" fill="#7C7F86"/>
                        <path d="M14.0565 8.64453C13.317 8.64453 12.7154 9.2624 12.7154 10.0219V10.5407H11.705V10.0219C11.705 9.2624 11.1037 8.64453 10.3642 8.64453C9.62472 8.64453 9.02344 9.2624 9.02344 10.0219C9.02344 10.7812 9.62501 11.3991 10.3642 11.3991H10.8693V15.7103C10.8687 15.7672 10.879 15.8234 10.8997 15.8761C10.9204 15.9287 10.9512 15.9767 10.99 16.017C11.0289 16.0574 11.0751 16.0895 11.1262 16.1114C11.1772 16.1332 11.232 16.1445 11.2872 16.1445C11.3425 16.1445 11.3973 16.1332 11.4482 16.1114C11.4993 16.0895 11.5455 16.0574 11.5845 16.017C11.6233 15.9767 11.6539 15.9287 11.6747 15.8761C11.6954 15.8234 11.7058 15.7672 11.7051 15.7103V11.3991H12.7154V15.7103C12.7155 15.8242 12.7595 15.9333 12.8379 16.0139C12.9162 16.0943 13.0226 16.1396 13.1334 16.1396C13.2443 16.1396 13.3505 16.0943 13.429 16.0139C13.5073 15.9333 13.5514 15.8242 13.5514 15.7103V11.3991H14.0565C14.7959 11.3991 15.3973 10.7812 15.3973 10.0219C15.3973 9.2624 14.7957 8.64453 14.0565 8.64453ZM10.3642 10.5406C10.0856 10.5406 9.85894 10.308 9.85894 10.0219C9.85894 9.7358 10.0857 9.50297 10.3642 9.50297C10.6426 9.50297 10.8693 9.7358 10.8693 10.0219V10.5407L10.3642 10.5406ZM14.0565 10.5406H13.5515V10.0219C13.5515 9.7358 13.7779 9.50297 14.0566 9.50297C14.3351 9.50297 14.5615 9.7358 14.5615 10.0219C14.5615 10.308 14.3351 10.5406 14.0565 10.5406Z" fill="#7C7F86"/>
                        <path d="M8.97887 18.3358H15.4403C15.6712 18.3358 15.8582 18.1486 15.8582 17.9178C15.8582 17.6871 15.6712 17.5 15.4403 17.5H8.97887C8.92358 17.4994 8.86872 17.5097 8.81747 17.5305C8.76621 17.5512 8.71957 17.5818 8.68025 17.6207C8.64094 17.6596 8.60973 17.7059 8.58842 17.7569C8.56713 17.8079 8.55615 17.8626 8.55615 17.918C8.55615 17.9733 8.56713 18.0279 8.58842 18.079C8.60973 18.13 8.64094 18.1763 8.68025 18.2151C8.71957 18.254 8.76621 18.2847 8.81747 18.3054C8.86872 18.3262 8.92358 18.3364 8.97887 18.3358ZM15.4403 20.2692H8.97887C8.92358 20.2686 8.86872 20.2789 8.81747 20.2996C8.76621 20.3204 8.71957 20.351 8.68025 20.39C8.64094 20.4288 8.60973 20.475 8.58842 20.5261C8.56713 20.5772 8.55615 20.6318 8.55615 20.6871C8.55615 20.7424 8.56713 20.7972 8.58842 20.8481C8.60973 20.8992 8.64094 20.9454 8.68025 20.9843C8.71957 21.0232 8.76621 21.0539 8.81747 21.0746C8.86872 21.0953 8.92358 21.1057 8.97887 21.105H15.4403C15.4955 21.1057 15.5503 21.0953 15.6016 21.0746C15.6529 21.0539 15.6995 21.0232 15.7389 20.9843C15.7781 20.9454 15.8093 20.8992 15.8307 20.8481C15.852 20.7972 15.8629 20.7424 15.8629 20.6871C15.8629 20.6318 15.852 20.5772 15.8307 20.5261C15.8093 20.475 15.7781 20.4288 15.7389 20.39C15.6995 20.351 15.6529 20.3204 15.6016 20.2996C15.5503 20.2789 15.4955 20.2686 15.4403 20.2692ZM15.4403 18.8846H8.97887C8.92358 18.884 8.86872 18.8943 8.81747 18.915C8.76621 18.9358 8.71957 18.9664 8.68025 19.0054C8.64094 19.0442 8.60973 19.0905 8.58842 19.1415C8.56713 19.1925 8.55615 19.2472 8.55615 19.3025C8.55615 19.3578 8.56713 19.4125 8.58842 19.4636C8.60973 19.5146 8.64094 19.5609 8.68025 19.5997C8.71957 19.6386 8.76621 19.6693 8.81747 19.69C8.86872 19.7108 8.92358 19.721 8.97887 19.7205H15.4403C15.4951 19.7205 15.5495 19.7097 15.6002 19.6887C15.6508 19.6677 15.697 19.6369 15.7358 19.5981C15.7745 19.5593 15.8054 19.5132 15.8263 19.4626C15.8474 19.4118 15.8582 19.3575 15.8582 19.3026C15.8582 19.1918 15.8141 19.0854 15.7358 19.007C15.6574 18.9287 15.5511 18.8846 15.4403 18.8846Z" fill="#7C7F86"/>
                        <path d="M15.8685 15.8008H8.48366C8.374 15.8026 8.26944 15.8474 8.19253 15.9256C8.11562 16.0038 8.07251 16.109 8.07251 16.2187C8.07251 16.3284 8.11562 16.4336 8.19253 16.5118C8.26944 16.59 8.374 16.6348 8.48366 16.6366H15.8683C15.9783 16.6353 16.0833 16.5908 16.1607 16.5126C16.2381 16.4344 16.2815 16.3288 16.2815 16.2188C16.2815 16.1088 16.2382 16.0032 16.1609 15.9249C16.0835 15.8467 15.9785 15.8021 15.8685 15.8008V15.8008Z" fill="#7C7F86"/>
                        </svg>
                      @endif 
                    
                  
                  </a>
                    <p class="mb-0 text-sm-10 count_is_like{{ $post['id'] }}">{{ $post['count_is_like'] }}</p>
                  </div>
                  <div class="post_comment text-center">
                    @if($post['count_comments']>0)
                    <a onclick="getMoreCommentsPopup({{ $post['id'] }})" class="p-0" data-bs-toggle="tooltip" data-bs-original-title="View comments">
                    @else
                    <a class="p-0 tooltip">
                    @endif
                    
                      <!-- <span class="tooltiptext">View Comments</span> -->
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      
                    <g clip-path="url(#clip0_6479_81269)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0323 12.5025H4.65771C4.50853 12.5025 4.36546 12.4433 4.25997 12.3378C4.15448 12.2323 4.09521 12.0892 4.09521 11.94C4.09521 11.7908 4.15448 11.6478 4.25997 11.5423C4.36546 11.4368 4.50853 11.3775 4.65771 11.3775H14.0323C14.1815 11.3775 14.3246 11.4368 14.4301 11.5423C14.5356 11.6478 14.5948 11.7908 14.5948 11.94C14.5948 12.0892 14.5356 12.2323 14.4301 12.3378C14.3246 12.4433 14.1815 12.5025 14.0323 12.5025ZM4.09484 9.11673C4.09491 8.96757 4.1542 8.82454 4.25967 8.71907C4.36515 8.6136 4.50818 8.55431 4.65734 8.55423H11.4683C11.6175 8.55423 11.7605 8.6135 11.866 8.71899C11.9715 8.82448 12.0308 8.96755 12.0308 9.11673C12.0308 9.26592 11.9715 9.40899 11.866 9.51448C11.7605 9.61997 11.6175 9.67923 11.4683 9.67923H4.65729C4.50815 9.67908 4.36517 9.61977 4.25971 9.51432C4.15425 9.40886 4.09499 9.26587 4.09484 9.11673ZM19.1937 20.5388L22.6411 21.4627L21.7189 18.0145C21.6993 17.9432 21.694 17.8687 21.7035 17.7954C21.713 17.7221 21.7371 17.6514 21.7743 17.5875C22.3789 16.5385 22.7447 15.3689 22.8453 14.1623C22.946 12.9557 22.7792 11.7417 22.3567 10.607C21.9343 9.47227 21.2666 8.44477 20.4013 7.59777C19.5361 6.75078 18.4946 6.10517 17.3511 5.707C19.5135 9.29856 19.048 14.0414 15.9532 17.136C14.2359 18.8522 11.9183 19.8332 9.49067 19.8713C10.7832 20.9137 12.3608 21.5408 14.0163 21.6699C15.6718 21.7991 17.3276 21.4244 18.7662 20.595C18.8303 20.558 18.901 20.5339 18.9743 20.5243C19.0477 20.5146 19.1222 20.5195 19.1937 20.5387V20.5388ZM4.95162 17.5725C5.05056 17.5724 5.14776 17.5984 5.23339 17.648C6.80109 18.5517 8.62301 18.9134 10.4171 18.6771C12.2111 18.4407 13.8772 17.6195 15.1573 16.3406C18.3626 13.1358 18.3626 7.92091 15.1573 4.71559C11.9521 1.51028 6.73761 1.5108 3.53234 4.71559C2.25343 5.99585 1.43228 7.66204 1.19604 9.45616C0.959801 11.2503 1.32165 13.0722 2.22556 14.6399C2.3002 14.7694 2.32043 14.9231 2.28181 15.0675L1.35785 18.5156L4.80598 17.5912C4.85355 17.5787 4.90253 17.5724 4.95171 17.5725H4.95162ZM22.8645 17.9447C23.5726 16.6432 23.9611 15.1919 23.9981 13.7107C24.0351 12.2295 23.7194 10.7607 23.0772 9.42545C22.435 8.09019 21.4846 6.92671 20.3043 6.03096C19.124 5.13521 17.7478 4.53284 16.2889 4.27352C16.1806 4.15352 16.0687 4.03572 15.9532 3.92012C12.3092 0.276625 6.38046 0.276625 2.73687 3.92012C1.31165 5.34723 0.385774 7.19669 0.0972457 9.19284C-0.191283 11.189 0.172988 13.2249 1.13576 14.9972L0.0189642 19.1653C-0.00322724 19.2487 -0.0059831 19.336 0.0109091 19.4206C0.0278013 19.5052 0.0638904 19.5848 0.116394 19.6532C0.168898 19.7216 0.236415 19.7771 0.31374 19.8153C0.391065 19.8535 0.476133 19.8735 0.562386 19.8736C0.61159 19.8735 0.660571 19.867 0.70812 19.8543L4.87582 18.7373C5.76091 19.2202 6.71877 19.5557 7.71176 19.7306C7.82037 19.8511 7.93245 19.9697 8.04682 20.0836C9.47371 21.5092 11.3232 22.4353 13.3195 22.7239C15.3158 23.0125 17.3518 22.648 19.124 21.6848L23.2912 22.8014C23.3866 22.827 23.4871 22.827 23.5826 22.8015C23.678 22.776 23.765 22.7258 23.835 22.6561C23.9045 22.5861 23.9546 22.4991 23.9802 22.4039C24.0059 22.3086 24.0062 22.2083 23.9811 22.1128L22.8645 17.9447Z" fill="#7C7F86"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_6479_81269">
                    <rect width="24" height="24" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>
                      </a>
                    <p class="mb-0 text-sm-10 count_comments_popup{{ $post['id'] }}">{{ $post['count_comments'] }}</p>
                  </div>
                  {{-- <div class="post_comment text-center"><a onclick="getMoreCommentsPopup({{ $post['id'] }})"><img class="in-svg" src="{{ asset('assets/images/commnet.svg') }}" alt=""></a>
                    <p class="mb-0 text-sm-10">{{ $post['count_comments'] }}</p>
                  </div> --}}
                       <div class="post_comment text-center">
                        <a onclick="postAction({{ $post['id'] }},{{ ($post['is_save']==0) ? 1 : 0  }},'is_save')" is_save="{{ $post['is_save'] }}" class='post-book{{ $post["id"] }} post-book p-0 {{ ($post["is_save"]==1) ? "active" : "" }}' data-bs-toggle="tooltip" data-bs-original-title="Save this post">
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
                        <p class="mb-0 text-sm-10 is_save_text{{ $post['id'] }}">{{ ($post['is_save']==1) ? "Saved" : "Save" }}</p>
                      </div> 
                </div>

                
              </div>
              <div class="cmt_user_detail_popup{{ $post['id'] }}">
              @if($post['post_comments'])
              <div class="d-flex gap-2">
                <div class="avtar p-0">
                  
                  <img class="rounded-circle" src="{{ ($post['post_comments'][0]['user']['profile_image_url']) ?? asset('assets/images/logo2.svg') }}" alt="">
                  
                      </div>
                <div class="d-lnline text-start">
                    <p class="mb-0 lh-sm title-font text-dark">@php echo ($post['post_comments'][0]['user']['first_name']) ?? ''; echo "&nbsp;",($post['post_comments'][0]['user']['last_name']) ?? '' @endphp</p>
                    <p class="mb-0 lh-sm text-sm-14">@php echo ($post['post_comments'][0]['user']['user_type']) ?? ''; @endphp</p>
                </div><span class="title-font text-sm-10">@php echo ($post['post_comments'][0]['created_at']) ?? ''; @endphp</span>
              </div>
              <div class="lm_cm-rep text-start mx-5 my-1">
                  <p class="text-sm-16 text-dark mb-0 title-font">
                    @php 
                    echo ($post['post_comments'][0]['comment_text']) ?? '' 
                    @endphp
                    
                  </p>
                  <div class="lm_rep d-flex gap-2">
                      <a onclick="getMoreCommentsPopup({{ $post['id'] }})" class="text-primary title-font text-sm-16" type="button">Reply</a>
                    @if($post['count_comments']>0 && (Auth::user()->id== ($post['post_comments'][0]['user']['id'] ?? null) || Auth::user()->is_admin==1))
                      <a onclick="getDeletPostCommentModal({{ $post['id'] }},{{ ($post['post_comments'][0]['id']) ?? '' }},1)" class="text-primary title-font text-sm-16" type="button">Delete</a>
                    @endif
                  </div>
                </div>
              @endif
              
              
            </div>
              
              
            {{-- post comment reply --}}

              <div class="post_comment-reply d-flex gap-2 mt-4">
                <div class="avtar p-0 shadow"><img class="rounded-circle object-fit-contain" src="{{ (Auth::user()->profile_image_url) ?? asset('assets/images/logo2.svg') }}" alt=""></div>
                <div class="post_comment-wrap position-relative w-100">
                  <input data-emojiable="true" name="yourThoughts"  id="yourThoughtsPopup{{ $post['id'] }}"
                  class="form-control border border-dark-subtle rounded-2 p-2 post_cmtt post_cmtt_popup{{ $post['id'] }}" type="text"
                  placeholder="Leave a comment...">
                    <span class="position-absolute top-50 end-0 translate-middle-y me-2">
                    </span>
                    <span class="help-block comment-error-popup{{ $post['id'] }} float-start" style="color: red;"></span>
                  </div>
              </div>

            {{-- post comment --}}

              <div class="post_cmtt-show post_cmtt-hide post_cmtt-show{{ $post['id'] }} active">
                 <div class="d-flex align-items-center justify-content-end mt-2 gap-2 me-2">
                   <button
                    class="btn btn--replay py-1 title-font comment_submit_popup__btn" id="comment_submit_popup_btn{{ $post['id'] }}"  onclick="SubmitYourThoughtPopup({{ $post['id'] }})">Comment</button>
                     {{-- <button class="btn btn-cancle lh-1 w-auto p-1" onfocus="cancelThought({{ $post['id'] }})">Cancel</button> --}}
                   </div> 
              </div>
            </div>
          </div>

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

            $(function() {
                $('[data-bs-toggle="tooltip"]').hover(function () {
                    var tooltipTitle = $(this).attr('data-bs-original-title');
                    $(this).attr('title', '');
                    $(this).tooltip({ title: tooltipTitle }).tooltip('show');
                }, function () {
                    $(this).tooltip('hide');
                });
                $(document).ready(function() {
                  $("#location_edit, #timezone_edit").select2({
                      dropdownParent: $("#offcanvasRight1")
                  });
                });   
            }); 
        </script>