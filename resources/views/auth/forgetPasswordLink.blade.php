<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEEQ</title>
    <link rel="shortcut icon" href="{{ asset('landing/assets/images/favicon1.ico')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('landing/style.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .logo_forget{
            width: 120px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        @media(max-width: 576px){
        .logo_forget{
            width: 70px;
        }
        }
    </style>
  </head>
  <body>
    <section class="main__page__content position-relative hero-forget">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-3">
                <a class="" href="#"> <img class="logo_forget" src="{{ asset('landing/assets/images/logo.svg') }}" alt=""></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-5 mx-auto">
                    <div class="lm__hero--section home-banner position-relative">
                        <div class="lm__login--box">
                            <div class="lm__shape-1">
                            <img src="{{ asset('landing/assets/images/shape1.svg')}}" alt="">
                            </div>
                            <div class="lm__shape-2">
                                <img src="{{ asset('landing/assets/images/shape2.svg')}}" alt="">
                            </div>
                            <div class="lm__shape-3"> <img class="in-svg"
                                src="{{ asset('landing/assets/images/logo-shape.png')}}" alt="">
                            </div>
                            <div class="lm__login-title">
                                <h2>Reset Password!</h2>
                                <p class="fw-normal">We'll send you an email where you can reset your password or sign in immediately with a magic link.</a>
                                </p>
                            </div>
                            <div class="lm__login-form">
                                @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                                @endif
                                <form action="{{ route('reset.password.post') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="userName" value="{{ $userName }}">
                                        <input type="hidden" name="email" value="{{ $email }}">
                                    <!-- Email -->
                                        <div class="col-12">
                                            <div class="lm__form-input mb-3">
                                                    <input id="email" type="email" placeholder="Email Address" class="form-control" name="email" value="{{ $email }}" autocomplete="email" id="email" disabled readonly=true>
                                                    <span><img class="in-svg" src="{{ asset('assets/images/mail.svg')}}" alt=""></span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="lm__form-input mb-3">
                                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"> 
                                                <span><img class="in-svg" src="{{ asset('assets/images/lock.svg')}}" alt=""></span>
                                                @error('password')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="lm__form-input mb-3">
                                                <input id="password_confirmation" type="password" placeholder="Confirm Password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                                                <span><img class="in-svg" src="{{ asset('assets/images/lock.svg')}}" alt=""></span>
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="col-12">
                                            <div class="lm__form--button"> <button class="btn btn-primary" type="submit" id="">Save</button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="lm__form-help">
                                                <p class="mb-0 text-white">Need Help? <a href="{{ route('landing.contact') }}" class="text-primary text-decoration-none">Contact Support</a></p>
                                            </div>
                                        </div>                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </body>
  </html>
  <script>
    $(document).ready(function(){        
        $("#email").change(function(e){
            e.preventDefault();
            var email = $(this).val();
            let url = '{{ route("check.email.user", ":email") }}';
            url = url.replace(':email', email); 
            $.ajax({
                url: url,
                method: "get"    
            }).done(function(response) {
                console.log(response.message);
                if(response.message == "register") {
                    $('.check_email').show();
                    $('.invalid-feedback').html('');
                } else {
                    $('.check_email').hide();
                }
            });
        });
    });
  </script>