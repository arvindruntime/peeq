@extends('layouts.admin.master')
@section('content')
{{-- {{ dd(Auth::user()->timezone_id) }} --}}
@php 
// $timeZones = timeZoneList(); 
// $UserTimeZone = Auth::user()->timezone_id ?? 99;
// $tmz = timeZoneList($UserTimeZone);
@endphp


{{-- {{ dd($timeZones[0]['abbreviation']) }} --}}

<main class="main-content auto-load" id="main">
    <section class="lm__dash-con lm__event-con"><span class="lm_vec"><img class="light"
                src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="lm__event lm__event-list">
                        <div class="lm__event-title">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-primary fw-semibold">Webinars & Events</h4>
                                @if(Auth::user()->is_admin==1)
                                <button class="btn btn--white create-btn shadow" type="button" data-bs-toggle="offcanvas" data-bs-target="#createEventOffcanvas"
                                    aria-controls="createEventOffcanvas">
                                    <span><img class="in-svg" src="assets/images/plus-3.svg" alt=""></span>Create</button>
                                @endif
                            </div>
                        </div>
                        <div class="lm__event-tab">
                            <ul class="nav nav-pills mb-4 nav-primary" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation" onclick="eventType('upcoming','1')">
                                    <button class="nav-link active"
                                        data-bs-toggle="pill" data-bs-target="#pills-all"
                                        type="button" role="tab" aria-controls="pills-all"
                                        aria-selected="true">Upcoming</button>
                                </li>
                                {{-- <li class="nav-item" role="presentation" onclick="eventType('ongoing','1')">
                                    <button class="nav-link"
                                    data-bs-toggle="pill" data-bs-target="#pills-all"
                                    type="button" role="tab"
                                        aria-selected="false">Ongoing</button>
                                </li> --}}
                                
                                {{-- <li class="nav-item" role="presentation" onclick="eventType('upcoming','1')">
                                    <button class="nav-link"
                                    data-bs-toggle="pill" data-bs-target="#pills-all"
                                    type="button" role="tab" aria-selected="false">Upcoming</button>
                                </li> --}}
                                <li class="nav-item" role="presentation" onclick="eventType('past','1')">
                                    <button class="nav-link"
                                    data-bs-toggle="pill" data-bs-target="#pills-all"
                                    type="button" role="tab"
                                        aria-selected="false">Past</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active event-data" id="pills-all" role="tabpanel"
                                    aria-labelledby="pills-all-tab" tabindex="0">

                                                                        
                                
                                    <div id="data-wrapper">
                                        @include('users.event.event_xhr')
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        {{-- {{ $events->links('pagination::bootstrap-4') }} --}}
                                    </div>
                                </div>
                                {{-- @include('layouts.admin.base.loader') --}}
                            </div>
                            
                            
                            
                            
                                <div class="tab-pane fade" id="pills-upcoming" role="tabpanel"
                                    aria-labelledby="pills-upcoming-tab" tabindex="0">...</div>
                                <div class="tab-pane fade" id="pills-past" role="tabpanel"
                                    aria-labelledby="pills-past-tab" tabindex="0">...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="{{ asset('assets/lib/main.js')}}"> </script>

<script>
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
            page++;
            infinteLoadMore(page,event_type);
        }
    });
</script>

@include('users.event.event_comman_js')
@include('users.event.event_modal')
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