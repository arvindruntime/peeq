@extends('layouts.admin.master')
@section('content')
   <main class="main-content" id="main">
        <section class="lm__dash-con lm__create-post global search"><span class="lm_vec"><img class="light"
                    src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
            <div class="container">
                
                @if((count($posts) > 0) || (count($users) > 0) || (count($courses) > 0))
                    <div class="row">
                        <div class="col col-md-12">
                            <div class="row">
                                {{-- post --}}
                                <div class="col-md-6">
                                    {{-- posts --}}
                                    @foreach($posts as $post) 
                                    <div class="lm_post-card lm_card-post my-4 glb-search" style="max-width: 553px">
                                        <div class="card border-0 px-4 py-4">
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div class="d-flex gap-2 align-items-center">
                                                        <div class="lm_card-post-logo"><span class="shadow p-0"><img class="in-svg rounded-circle object-fit-cover" style="height:100%; width:100%;" src="{{ $post['user']['profile_image_url'] ?? asset('assets/images/logo2.svg') }}" alt=""></span></div>
                                                    <div class="d-lnline">
                                                        <h5 class="mb-1">{{ $post['user']['first_name'] }} {{ $post['user']['last_name'] }}</h5>
                                                        <p class="mb-0">{{ $post['user']['user_type'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post_inner-card-con">
                                                <p class="mb-0 title-font">{!! html_entity_decode($post['content']) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    {{-- courses --}}
                                    <div class="lm_course-list-after-create">
                                        <div class="lm__course ">
                                            <div class="lm_course-con">
            
                                                <div class="row gap-4 gap-md-0" id="data-wrapper">
                                                    @foreach ($courses as $course)
                                                    <div class="col-md-6">
                                                        <div class="lm_course-card card border-0 shadow">
                                                        <div class="card-img position-relative">
                                                            <img src="{{ $course['course_thumbnail'] }}" alt="" height="400px" width="500px">
                                                            
                                                            @if($course['course_price_type']=="paid")
                                                            <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                                                                class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font"> {{ '$'.$course['course_price'].' AUD' ??  ''}}</span>
                                                            </div>
                                                            @endif
                                                            
                                                            @if($course['course_price_type']=="free")
                                                            <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                                                                class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font"> Free</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="card-body px-0 pb-0">
                                                            <div class="d-flex align-items-center gap-2 mb-2">
                                                            <h4 class="mb-0"> <a class="text-dark" href="{{ route('user.courses.view', ['id' => $course['id']]) }}">{{ $course['course_name'] }}</a></h4>
                                                            </div>
                                                            <p class="mb-2">{!! $course['description'] !!}
                                                            </p>
                                                            
                                                            <div class="d-flex align-items-end justify-content-between">
                                                            <div class="d-block">
                                                                <span class="text-dark title-font">Coaches</span>
                                                                <div class="avtar-group mt-1">
                                                                
                                                                
                                                                @foreach ($course['coaches'] as $coach)
                                                                <div class="avtar-55"><img src="{{ $coach->profile_image_url ?? asset('assets/images/ev1.jpg')}}" ></div>
                                                                @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="d-flex gap-2">
                                                                
                                                            @if(Auth::user()->is_admin==1)
                                                                <div class="lm__hover">
                                                                <div class="d-flex gap-2">
                                                                    <span><a href="{{ route('user.courses.view', ['id' => $course['id']]) }}"> <img class="in-svg" src="{{asset('assets/images/eye.svg')}}" alt=""></a></span>
                                                                    <span> <a onclick="OpenShareCourseModal('{{ route('user.courses.view', ['id' => $course['id']]) }}')"> <img class="in-svg" src="{{asset('assets/images/share.svg')}}" alt=""></a></span>
                                                                    <span><a href="{{ $course['upload_pdf'] }}" download="{{ $course['upload_pdf']}}"><img class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span>
                                                                    <span><a href="{{ route('admin.course.edit', ['id' => $course['id']]) }}"> <img class="in-svg" src="{{asset('assets/images/pen.svg')}}" alt=""></a></span>
                                                                </div>
                                                                </div>
                                                            @else
                                                                <div class="lm__hover">
                                                                <div class="d-flex gap-2">
                                                                    <span><a onclick="OpenShareCourseModal('{{ route('user.courses.view', ['id' => $course['id']]) }}')">
                                                                    <img class="in-svg" src="{{asset('assets/images/share.svg')}}" alt="">
                                                                    </a>
                                                                    </span>
                                                                    <span><a href="{{ $course['upload_pdf'] }}" download="{{ $course['upload_pdf']}}"> <img class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span> 
                                                                </div>
                                                                </div>
                                                            @endif
                                                                
                                                                <div class="d-block">
                                                                @if(Auth::user()->is_admin==1)
                                                                <a class="btn btn--dark-lenear py-2 text-sm-18" href="{{ route('admin.courses.inner' , ['id' => $course['id']]) }}">Add Module</a>
                                                                @else
                                                                    @if($course['course_price_type']=="paid" && $course['course_purchase_status']==0)
                                                                    <a class="btn btn--dark-lenear text-primary py-2" href="{{ route('user.courses.buy' , ['id' => $course['id']]) }}">Buy</a>
                                                                    @else
                                                                    <a class="btn btn--dark-lenear py-2 text-sm-18" href="{{ route('user.courses.view', ['id' => $course['id']]) }}">View Course</a>
                                                                    @endif
                                                                @endif
                                                                
                                                                </div>
                                                            </div>
                                                            </div>                     
                                                            
                                                        </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            
                            
                            {{-- users --}}
                            @foreach($users as $user)
                            <div class="lm__member-card mb-3">
                                <div class="card shadow p-3 border-0">
                                    <div class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                                        <div class="d-flex align-items-center gap-2 mb-2 mb-sm-0">
                                            <div class="avtar-xxl"><img class="rounded-circle position-relative"
                                                    src="{{ $user['profile_image_url'] ?? asset('assets/images/logo2.svg') }}" alt=""></div>
                                                    
                                            <div class="d-block">
                                                <h6 class="mb-0 text-dark">{{ $user['first_name'] }} {{ $user['last_name'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
    
                        </div>   
                    </div>
                @else
                    <p class="align-items-center"> No results found.</p>
                @endif
            </div>
        </section>
    </main>
@endsection