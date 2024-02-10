@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
    <section class="lm__dash-con lm__event-con"><span class="lm_vec"><img class="light"
                src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="lm__event lm__event-list">
                        <div class="lm__event-title">
                            <div class="d-flex justify-content-between">
                                <h4 class="text-primary fw-semibold">Events</h4><button class="btn btn--white create-btn shadow" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#createEventOffcanvas"
                                    aria-controls="createEventOffcanvas"> <span><img class="in-svg"
                                            src="assets/images/plus-3.svg" alt=""></span>Create</button>
                            </div>
                        </div>
                        <div class="lm__event-tab">
                            <ul class="nav nav-pills mb-4 nav-primary" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation"><button class="nav-link active"
                                        id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all"
                                        type="button" role="tab" aria-controls="pills-all"
                                        aria-selected="true">All</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link"
                                        id="pills-upcoming-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-upcoming" type="button" role="tab"
                                        aria-controls="pills-upcoming" aria-selected="false">Upcoming</button></li>
                                <li class="nav-item" role="presentation"><button class="nav-link"
                                        id="pills-past-tab" data-bs-toggle="pill" data-bs-target="#pills-past"
                                        type="button" role="tab" aria-controls="pills-past"
                                        aria-selected="false">Past</button></li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-all" role="tabpanel"
                                    aria-labelledby="pills-all-tab" tabindex="0">
                                    <div class="lm__event-card">
                                        <div class="card shadow p-3 border-0">
                                            <div
                                                class="d-sm-flex flex-wrap align-items-center gap-2 justify-content-between">
                                                <div class="d-sm-flex align-items-center gap-3 mb-2 mb-sm-0 w-100">
                                                    <div class="event-img"><img class="position-relative"
                                                            src="assets/images/event-img-01.jpg" alt=""></div>
                                                    <div class="d-block w-100 mt-3 mt-sm-0">
                                                        <p class="title-font mb-0 text-primary">TOMORROW • 3:00PM
                                                        </p>
                                                        <h4 class="mb-0 text-dark">Being a Leader Master Class With
                                                            Zoe Williams</h4>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between">
                                                            <div class="d-block w-100">
                                                                <div class="d-flex gap-2 align-items-center py-2">
                                                                    <span><img class="in-svg"
                                                                            src="assets/images/zoom.svg"
                                                                            alt=""></span><span
                                                                        class="text-sm-12">Zoom Meeting</span></div>
                                                                <div class="avtar-group">
                                                                    <div class="avtar-25"><img
                                                                            src="assets/images/avtar-10.jpg" alt="">
                                                                    </div>
                                                                    <div class="avtar-25"><img
                                                                            src="assets/images/avtar-20.jpg" alt="">
                                                                    </div>
                                                                    <div class="avtar-25"><img
                                                                            src="assets/images/member-3.jpg" alt="">
                                                                    </div>
                                                                    <p class="mb-0 text-sm-12 ms-2">3 Going</p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="d-flex gap-3 align-items-center lm__member-btn w-100 justify-content-end">
                                                                <a class="btn btn--primary py-1 title-font px-4 h6"
                                                                    href="#">View Event </a>
                                                                <div class="dropdown mt-1"><a
                                                                        class="dropdown-toggle" type="button"
                                                                        data-bs-toggle="dropdown"
                                                                        aria-expanded="false"><span><img
                                                                                class="in-svg"
                                                                                src="assets/images/dots-1.svg"
                                                                                alt=""></span></a>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item">Add to
                                                                                Calendar</a></li>
                                                                        <li><a class="dropdown-item">Save/Unsave
                                                                                Event</a></li>
                                                                        <li><a class="dropdown-item" type="button"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#muteEventModal">Mute
                                                                                Event</a></li>
                                                                        <li class="dropdown dropdown-submenu"><a
                                                                                class="dropdown-item" href="#"
                                                                                data-toggle="dropdown">Share</a>
                                                                            <ul class="dropdown-menu">
                                                                                <li class="d-flex"><a
                                                                                        class="dropdown-item w-auto"
                                                                                        href="#"><span
                                                                                            class="icon-md"><img
                                                                                                class="in-svg"
                                                                                                src="assets/images/mail-to.svg"
                                                                                                alt=""></span></a><a
                                                                                        class="dropdown-item w-auto"
                                                                                        href="#"><span
                                                                                            class="icon-md"><img
                                                                                                class="in-svg"
                                                                                                src="assets/images/link-to.svg"
                                                                                                alt=""></span></a>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li class="divider"></li>
                                                                        <li
                                                                            class="dropdown dropdown-submenu toggler">
                                                                            <a class="dropdown-item" href="#"
                                                                                data-toggle="dropdown">Add this
                                                                                to..</a>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-inner py-3">
                                                                                <li class="px-3">
                                                                                    <div class="lm__term mb-3">
                                                                                        <label
                                                                                            class="lm-check-term ps-4 mb-0 lh-1">Network
                                                                                            Host<input
                                                                                                type="checkbox"><span
                                                                                                class="checkmark"></span></label>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="px-3">
                                                                                    <div class="lm__term mb-3">
                                                                                        <label
                                                                                            class="lm-check-term ps-4 mb-0 lh-1">Network
                                                                                            Moderator<input
                                                                                                type="checkbox"><span
                                                                                                class="checkmark"></span></label>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="px-3">
                                                                                    <div class="lm__term"><label
                                                                                            class="lm-check-term ps-4 mb-0 lh-1">Network
                                                                                            Member<input
                                                                                                type="checkbox"><span
                                                                                                class="checkmark"></span></label>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </li>
                                                                        <li> <a class="dropdown-item">Download
                                                                                RSVPs</a></li>
                                                                        <li> <a class="dropdown-item" type="button"
                                                                                data-bs-toggle="offcanvas"
                                                                                data-bs-target="#manageEventSettingModal"
                                                                                aria-controls="manageEventSettingModal">Event
                                                                                Settings</a></li>
                                                                        <li> <a class="dropdown-item">Duplicate
                                                                                Event</a></li>
                                                                        <li> <a class="dropdown-item" type="button"
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal23">Delete
                                                                                Event</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
@endsection