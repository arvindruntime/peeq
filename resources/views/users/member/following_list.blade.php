@extends('layouts.admin.master')
@section('content')

<main class="main-content auto-load" id="main"> 
    <section class="lm__dash-con lm__member-con"><span class="lm_vec"><img class="light" src="assets/images/light.png" alt=""><img class="dark" src="assets/images/dark.png" alt=""></span>
      <div class="container">
        <div class="lm__member">
          <div class="row">
            <div class="col-12"> 
              <h4 class="text-primary fw-semibold">Following Members</h4>
              
              
              <div class="tab-content mt-sm-3">
                {{-- <div id="loader-container-members" class="loader-container">
                  <div class="loader"></div>
                </div> --}}
                <div class="tab-pane active member-data" id="top" role="tabpanel" aria-labelledby="top-tab" tabindex="0">
                  @include('users.member.following_list_xhr')
                </div>
                <div class="mt-3">
                  <div class="d-flex justify-content-end">
                    {{-- {{ $response['data']['data']->links('pagination::bootstrap-4') }} --}}
                    {{-- {!! $memberLists->appends(['user_type' => 'newest'])->links() !!} --}}
                  </div>
                </div>
                {{-- <div id="no-records" style="display: none;"><!-- Inside your Blade file -->
                  <p>{{ $no_records }}</p>
                </div> --}}
              </div>
              
              
              
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection