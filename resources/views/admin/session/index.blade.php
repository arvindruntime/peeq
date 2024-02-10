@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
  <section class="lm__dash-con lm__course-list-admin lm_session-create">
      <span class="lm_vec"><img class="light"
        src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="create-list-admin">
              <div class="create-list-admin-title">
                <h4 class="mb-0 text-primary fw-semibold">PEEQ Session</h4>
              </div>
              <div class="create-list-admin-tab">
                <a class="create_admin-course d-flex justify-content-center" href="{{ route('web.admin.session.create') }}">
                  <div class="create-course-btn text-primary gap-2"> <span> <img class="in-svg"
                    src="{{asset('assets/images/plus-3.svg')}}" alt=""></span>Create Session</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
</main>

@endsection