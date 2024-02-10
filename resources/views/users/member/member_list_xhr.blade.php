{{-- {{ dd($memberLists) }} --}}
@foreach ($memberLists as $member)
@php if($member->id == Auth::user()->id) continue @endphp
                    {{-- {{ dd($member->first_name) }} --}}
                  <div class="lm__member-card mb-3 member-data">
                    <div class="card shadow p-3 border-0"> 
                      <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                        <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                          <div class="avtar-xxl shadow">
                            <a class="w-100 h-100" onclick="ViewMemberProfile({{ $member->id }})">
                            <img class="rounded-circle position-relative" src="{{ ($member->profile_image_url) ?? asset('assets/images/member-1.jpg')}} " alt="{{ $member->first_name .' '.$member->last_name }}">
                            </a>
                            @if($member['user_type']=="Host")
                            <div class="position-absolute top-0 start-0">
                              <span><img src="{{asset('assets/images/crown1.svg')}}" alt=""></span>
                            </div>
                            @endif

                            @if($member['user_type']=="Coach")
                            <div class="position-absolute top-0 start-0">
                              <span><img src="{{asset('assets/images/star-fill.svg')}}" alt=""> </span>
                            </div>
                            @endif
                        
                            {{-- <div class="avtar-active"></div> --}}
                          </div>
                          <div class="d-block">
                            <h6 class="mb-0 text-dark" onclick="ViewMemberProfile({{ $member->id }})" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight10" aria-controls="offcanvasRight10"> {{ $member->first_name .' '.$member->last_name }}</h6>
                            <p class="title-font mb-0">{{ $member->user_type}}</p>
                          </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center lm__member-btn">
                          
                          @if($member->is_block_member==0)
                          @if($member->is_follow==1)
                          <a class="btn btn--chat btn-follow active py-1 title-font px-3 memberId{{ $member->id }}" onclick="memberActivityAction('follow',{{ $member->id }},{{ ($member->is_follow==1) ? '0' : '1' }},{{ ($member->is_block_member==1) ? '0' : '1' }},'{{ ($member['user_type'] == 'Member') ? 'all' : (($member['user_type'] == 'Coach') ? 'coach' : 'all') }}')">{{ ($member->is_follow==1) ? 'Following' : 'Follow'}} </a>
                          @else
                          <a class="btn btn--chat btn-follow py-1 title-font px-3 memberId{{ $member->id }}" onclick="memberActivityAction('follow',{{ $member->id }},{{ ($member->is_follow==1) ? '0' : '1' }},{{ ($member->is_block_member==1) ? '0' : '1' }},'{{ ($member['user_type'] == 'Member') ? 'all' : (($member['user_type'] == 'Coach') ? 'coach' : 'all') }}')">{{ ($member->is_follow==1) ? 'Following' : 'Follow'}} </a>
                          @endif
                          {{-- <a class="btn btn--chat py-1 title-font px-3" href="{{ ("chat_memberlist") }}?user_id={{$member->id}}">Chat</a> --}}
                          <div class="dropdown mt-1"><a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><span>
                            <!-- Svg -->
                            <svg width="4" height="18" viewBox="0 0 4 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_2661_18626)">
                              <path d="M2 4C3.10456 4 4 3.10457 4 2C4 0.895428 3.10456 0 2 0C0.895438 0 0 0.895428 0 2C0 3.10457 0.895438 4 2 4Z" fill="#252A36"/><path d="M2 11C3.10456 11 4 10.1046 4 9C4 7.89543 3.10456 7 2 7C0.895438 7 0 7.89543 0 9C0 10.1046 0.895438 11 2 11Z" fill="#252A36"/><path d="M2 18C3.10456 18 4 17.1046 4 16C4 14.8954 3.10456 14 2 14C0.895438 14 0 14.8954 0 16C0 17.1046 0.895438 18 2 18Z" fill="#252A36"/>
                              <g filter="url(#filter0_d_2661_18626)"><rect x="-80" y="25" width="320" height="168" rx="20" fill="white"/>
                              </g></g><defs><filter id="filter0_d_2661_18626" x="-88" y="17" width="336" height="184" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/><feOffset/><feGaussianBlur stdDeviation="4"/>
                              <feComposite in2="hardAlpha" operator="out"/><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.15 0"/><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2661_18626"/>
                              <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2661_18626" result="shape"/>
                              </filter><clipPath id="clip0_2661_18626"><rect width="4" height="18" fill="white"/></clipPath></defs>
                            </svg>
                            </span></a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" onclick="OpenMemberModal('member_block_modal','{{ $member->first_name}}','{{ $member->id}}','{{ $user_type }}')" type="button" data-bs-toggle="modal">Block {{ $member->first_name}}</a></li>
                              <li><a class="dropdown-item" onclick="OpenMemberModal('reportMemberModal','{{ $member->first_name}}','{{ $member->id}}','{{ $user_type }}')" type="button" >Report {{ $member->first_name}}</a></li>
                              {{-- <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal16">Remove from Network</a></li> --}}
                              {{-- <li class="dropdown dropdown-submenu toggler"><a class="dropdown-item" href="#" data-toggle="dropdown">Add this to..</a>
                                <ul class="dropdown-menu dropdown-menu-inner py-3">
                                  <li class="px-3">
                                    <div class="lm__term mb-3">
                                      <label class="lm-check-term ps-4 mb-0 lh-1">Network Host
                                        <input type="checkbox"><span class="checkmark"></span>
                                      </label>
                                    </div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term mb-3">
                                      <label class="lm-check-term ps-4 mb-0 lh-1">Network Moderator
                                        <input type="checkbox"><span class="checkmark"></span>
                                      </label>
                                    </div>
                                  </li>
                                  <li class="px-3">
                                    <div class="lm__term">
                                      <label class="lm-check-term ps-4 mb-0 lh-1">Network Member
                                        <input type="checkbox"><span class="checkmark"></span>
                                      </label>
                                    </div>
                                  </li>
                                </ul>
                              </li> --}}
                            </ul>
                          </div>
                          @else
                          
                            @if($member->is_block_member==1)
                            <a class="btn btn--chat btn-follow active py-1 title-font px-3" onclick="memberActivityAction('block',{{ $member->id }},{{ ($member->is_follow==1) ? '0' : '1' }},{{ ($member->is_block_member==1) ? '0' : '1' }},'blocked')">{{ ($member->is_block_member==1) ? 'Unblock' : 'Block'}} </a>
                            @endif
                          
                          @endif
                        </div>
                      </div>
                    </div> 
                  </div>
                @endforeach
                