
@php
    $user = Auth::user();
@endphp
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal">
    <div class="modal-content">
    <div class="modal-body p-4">
        <div class="lm__term--title">
        <h3 class="mb-2">Accept our terms of service</h3>
        <p class="mb-2">To continue, please accept our Terms of Service</p>
        </div>
        <div class="lm__term">
        <label class="lm-check-term">I agree to the Terms of Service and Privacy Policy (required)
            <input type="checkbox" checked="checked"><span class="checkmark"> </span>
        </label>
        <label class="lm-check-term">I agree to receive activity emails from this Mighty Network. I can refine or revoke this consent anytime. (opt-in)
            <input type="checkbox" checked="checked"><span class="checkmark"> </span>
        </label>
        <label class="lm-check-term">I agree to receive activity emails from this Mighty Network. I can refine or revoke this consent anytime. (opt-in)
            <input type="checkbox" checked="checked"><span class="checkmark"> </span>
        </label>
        <label class="lm-check-term">I agree to receive commercial emails from this Mighty Network. I can revoke this consent at any time by unsubscribing to any commercial email from this Host. (opt-in)
            <input type="checkbox" checked="checked"><span class="checkmark"></span>
        </label>
        <div class="lm__term--button"> 
            <button class="btn btn--primary">Confirm</button>
            <button class="close-button" type="button" data-bs-dismiss="modal">Cancle</button>
        </div>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-2">
    <div class="modal-content">
    <div class="modal-body p-4 text-center">
        <div class="lm__term--title">
        <h3 class="mb-2 fw-bold">Are you sure you want to sign out?</h3>
        </div>
        <div class="lm__term--button"> 
        <button class="btn btn--primary">Yes, Sign Out</button>
        <button class="close-button" type="button" data-bs-dismiss="modal">Cancle</button>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-2">
    <div class="modal-content">
    <div class="modal-body p-4 text-center"><span class="mb-2"><img class="in-svg mx-auto" src="{{ asset('assets/images/CheckCircle.svg') }}" alt=""></span>
        <div class="lm__term--title">
        <h3 class="my-2 fw-bold">Success!</h3>
        <p class="text-light mb-2">Lorem ipsum dolor sit amet consectetur. Feugiat nibh proin orci mattis proin massa platea adipiscing odio</p>
        </div>
        <div class="lm__term--button mt-3"> 
        <button class="btn btn--primary me-0">Go to Dashboard</button>
        </div>
    </div>
    </div>
    </div>
</div>
{{-- <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered lm__modal-3">
    <div class="modal-content overflow-hidden">
    <div class="modal-body p-4 text-center position-relative">
        <div class="lm__shape-1 position-absolute top-0 start-0"><img class="in-svg" src="{{ asset('assets/images/shape1.svg') }}" alt=""></div>
        <div class="lm__shape-2 position-absolute bottom-0 end-0"><img class="in-svg" src="{{ asset('assets/images/shape33.svg') }}" alt=""></div>
        <div class="lm__shape-3"> <img class="in-svg" src="{{ asset('assets/images/logoshape1.png') }}" alt=""></div>
        <div class="lm__modal-body">
        <div class="lm__modal-3-con position-relative z-index-3">
            <h2 class="text-white">Welcome to our Ambassador Launch1</h2>
        </div>
        <div class="lm__modal-3-video position-relative z-index-3 mb-3">
            <iframe width="750" height="425" src="https://www.youtube.com/embed/DFSK_sVwOY8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
        <div class="lm__modal-3-con position-relative z-index-3">
            <p class="text-white">As a valued friend of PEEQ, we are thrilled to have you in our Global Leadership Network. Alongside a select circle of leaders, hand-picked by Zoe, we are excited to welcome you into this brand-new, exclusive Network. You are part of a group of CEOs, Executives, Team Leaders and Business Owners who we have chosen to connect within the PEEQ experience first. The reason we have chosen you is that you have already shown interest in learning more from Zoe and the PEEQ team and we wanted to find a way to give you access to this without having to rely on scheduled calls, meetings or even in-person appointments.</p>
        </div>
        <div class="lm__modal-btn"> 
            <button class="btn btn--primary px-5" data-bs-dismiss="modal">Continue1</button>
        </div>
        </div>
    </div>
    </div>
    </div>
</div> --}}




<div class="offcanvas offcanvas-end lm_profile-modal lm_create-modal" id="offcanvasRight13" tabindex="-1"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Skip</h5><button class="btn-close" type="button"
            data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="lm_profile-modal p-2">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <h5 class="text-white mb-0">Media Library</h5>
                </div>
            </div>
        </div>
        <div class="lm_create-body gallary-body">
            <form action="">
                <div class="input-group mb-3"><label class="input-group-text lm__upload-file" for="inputGroupFile01">
                        <div class="d-block"> <span class="d-block upd-title">Upload</span>
                            <div class="d-block"><span class="d-flex justify-content-center"> <img class="in-svg"
                                        src="{{asset('assets/images/file.svg')}}" alt=""></span></div>
                            <h6 class="d-block">Drag & Drop Media here</h6>
                        </div>
                    </label><input class="form-control" id="inputGroupFile01" type="file"></div>
                <div class="lm__course-tab lm__upd-tab">
                    <div class="d-flex justify-content-between flex-wrap mb-3">
                        <ul class="nav nav-pills mb-3 shadow" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active"
                                    id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery"
                                    type="button" role="tab" aria-controls="pills-gallery"
                                    aria-selected="true">Gallery</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="pills-images-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-images" type="button" role="tab"
                                    aria-controls="pills-images" aria-selected="false">Images</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="pills-videos-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab"
                                    aria-controls="pills-videos" aria-selected="false">Videos</button></li>
                        </ul>
                        <div class="lm__insdtl">
                            <div class="d-flex gap-2"><button class="btn btn--primary py-2">Insert </button><button
                                    class="btn btn--danger py-2">Delete</button></div>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-gallery" role="tabpanel"
                            aria-labelledby="pills-gallery-tab" tabindex="0">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g6.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip1"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g8.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip2"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip2">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g7.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip3"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip3">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g9.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip4"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip4">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip5"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip5">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g1.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip6"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip6">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g2.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip7"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip7">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g4.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip8"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip8">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g3.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip9"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip9">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g5.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip10"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip10">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g11.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip11"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip11">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip12"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip12">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g13.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip13"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip13">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g12.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip14"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip14">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g14.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip15"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip15">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-images" role="tabpanel" aria-labelledby="pills-images-tab"
                            tabindex="0">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g6.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip1"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g8.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip2"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip2">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g7.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip3"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip3">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g9.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip4"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip4">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g1.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip6"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip6">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g2.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip7"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip7">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g4.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip8"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip8">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g5.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip10"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip10">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g11.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip11"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip11">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g13.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip13"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip13">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g12.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip14"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip14">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g14.jpg')}}" alt="">
                                    <div class="card-img-overlay"><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip15"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip15">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab"
                            tabindex="0">
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g3.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip9"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip9">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip5"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip5">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card lm-img-box"><img class="card-img" src="{{asset('assets/images/g10.jpg')}}" alt="">
                                    <div class="card-img-overlay"><span class="play"><img class="in-svg"
                                                src="{{asset('assets/images/play-1.svg')}}" alt=""></span><a
                                            class="glyphicon glyphicon-question-sign append text-info tip"
                                            data-tip="tip12"><span class="icon-hov"> <img class="in-svg"
                                                    src="{{asset('assets/images/info3.svg')}}" alt=""></span></a>
                                        <div class="tip-content hidden" id="tip12">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark"> File
                                                    Name</span><span class="color-light"> filename.jpeg</span></div>
                                            <hr class="my-1">
                                            <div class="d-flex gap-2 title-font"><span class="text-dark">File
                                                    Size</span><span class="color-light">21.56kb</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

