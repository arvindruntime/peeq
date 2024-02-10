@extends('layouts.master')
@section('content')
    <header class="lm__header-logo">
        <div class="container-fluid">
            <div class="row">
                <div class="col"> <a class="lm-logo" href="{{config('app.url')}}/"><img class="in-svg" src="{{ asset('assets/images/logo.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
    </header>
    <main class="main-content" id="main">
        <section class="lm__hero">
            <div class="lm__hero--inner">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-10 mx-auto">
                            <div class="lm__login--box">
                                <div class="lm__login-title">
                                    <h2>Sign Up</h2>
                                    <p class="fw-normal">Already have an account? <a href="{{ route('login') }}"> Sign In</a></p>
                                </div>
                                <div class="lm__login-form">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col col-lg-3 lm__upd-col pe-lg-4 d-none">
                                                {{-- <div class="lm__upd"><label for="profile_image"> <img class="in-svg mx-auto" src="{{ asset('assets/images/upload.svg')}}" alt="">
                                                        <input id="profile_image" hidden type="file" name="profile_image"><br><span class="flex">
                                                        <img class="in-svg" src="{{ asset('assets/images/PlusLg.svg')}}" alt="">Upload Photo</span></label>
                                                    <div class="lm__ac--login">
                                                        <p>OR</p>
                                                    </div>
                                                    <div class="lm__link flex align-items-center">
                                                        <p class="mb-0 mr-2">Link photo from</p>
                                                        <img class="in-svg" src="{{ asset('assets/images/linkedin.svg')}}" alt="">
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="col col-lg-9 ps-lg-4 mx-auto">
                                                <div class="row">
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="first_name" type="text" placeholder="First Name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" autofocus> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/man.svg')}}" alt=""></span>
                                                            @error('first_name')
                                                            <div class="invalid-feedback position-absolute" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="last_name" type="text" placeholder="Last Name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" autofocus> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/man.svg')}}" alt=""></span>
                                                            @error('last_name')
                                                                <div class="invalid-feedback position-absolute" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="mobile_no" type="text" placeholder="Mobile Number" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" autocomplete="mobile_no" autofocus>
                                                            <span><img class="in-svg" src="{{ asset('assets/images/call.svg')}}" alt=""></span>
                                                            @error('mobile_no')
                                                                <div class="invalid-feedback position-absolute" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="email" type="email" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email"> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/mail.svg')}}" alt=""></span>
                                                            @error('email')
                                                                <div class="invalid-feedback position-absolute" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"> 
                                                            <span><img class="in-svg" src="{{ asset('assets/images/lock.svg')}}" alt=""></span>
                                                            @error('password')
                                                                <div class="invalid-feedback position-absolute" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col col-lg-6">
                                                        <div class="lm__form-input"> <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                                                            <span><img class="in-svg" src="{{ asset('assets/images/lock.svg')}}" alt=""></span>
                                                            @error('password_confirmation')
                                                                <div class="invalid-feedback position-absolute" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="lm__form--button"><button class="btn btn--primary"
                                                                type="submit" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">Sign Up </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="lm__ac--login">
                                        <p>OR Connect With</p>
                                    </div>
                                    <div class="lm__ac--social flex flex-wrap justify-content-center mb-3 gap-3"><a
                                            class="btn btn--white mb-2" href="#"> <img src="{{ asset('assets/images/facebook.svg')}}"
                                                alt="">Facebook</a><a class="btn btn--white mb-2" href="#"> <img
                                                src="{{ asset('assets/images/google.svg')}}" alt="">Google</a><a
                                            class="btn btn--white mb-2" href="#"> <img src="{{ asset('assets/images/linkedin.svg')}}"
                                                alt="">Linkedin</a><a class="btn btn--white mb-2" href="#"> <img
                                                src="{{ asset('assets/images/apple.svg')}}" alt="">Apple</a></div>
                                    <div class="lm__form-privacy sign-up">
                                        <p>You agree to the <a href="#"> PEEQ Terms </a> and <a
                                                href="#">Privacy Policy </a> Copyright ©2023 PEEQ.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
