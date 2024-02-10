@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
      <section class="lm__dash-con mb-5 lm__course-settings">
        <span class="lm_vec"><img class="light"
          src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
        <div class="container">
          <div class="row lm__course-setting-inn">
            <div class="col-12">
              <div class="lm__course-setting-title">
                <h4 class="text-primary fw-semibold">Course setting</h4>
              </div>
              <div class="lm__course-setting-card card">
                <h5 class="fw-bold">Privacy</h5>
                <div class="lm__cousre-radio">
                  <div class="radio-list">
                    <div class="radio"><label class="radio-lable checked11"><input type="radio" name="action"
                      value="secret" checked> Secret</label></div>
                    <div class="radio"><label class="radio-lable"><input type="radio" name="action" value="private">
                      Private</label>
                    </div>
                    <div class="radio"><label class="radio-lable"><input type="radio" name="action" value="public">
                      Public</label>
                    </div>
                  </div>
                </div>
                <div class="lm__cousre-radio-con">
                  <div class="show-hide" id="secret">
                    <p class="text-sm-14 mb-0">We've made this Course secret while you get it set up. If you're ready for
                      this Course to go live now, feel free to choose another privacy setting.
                    </p>
                  </div>
                  <div class="show-hide show" id="private">
                    <p class="text-sm-14 mb-0">Only members with an invite are allowed to sign up and join. Course will
                      not appear in search results.
                    </p>
                    <div class="invite-card card">
                      <h6 class="mb-1">Invites</h6>
                      <p class="mb-0 text-sm-14">Because your Course is set to Private, an invite only will allow someone
                        to join or being approved by a Host. Choose who is allowed to send Invites.
                      </p>
                      <div class="lm_post-input-emoji mb-2 me-3">
                        <select
                          class="form-select form-control js-example-basic-single" id="select_box5">
                          <option>All Members Can Invite</option>
                          <option value="a">All Members Can Invite</option>
                          <option value="c">All Members Can Invite</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="show-hide show" id="public">
                    <p class="text-sm-14 mb-0">Members can sign up and join without receiving an invitation from host.</p>
                    <div class="invite-card card">
                      <h6 class="mb-1">Invites</h6>
                      <p class="mb-0 text-sm-14">Because your Course is set to Private, an invite only will allow someone
                        to join or being approved by a Host. Choose who is allowed to send Invites.
                      </p>
                      <div class="lm_post-input-emoji mb-2 me-3">
                        <select
                          class="form-select form-control js-example-basic-single" id="select_box2">
                          <option>All Members Can Invite</option>
                          <option value="a">All Members Can Invite</option>
                          <option value="c">All Members Can Invite</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="lm__course-archive">
                  <h5 class="fw-bold">Archive</h5>
                </div>
                <div class="lm_on-off shadow">
                  <div class="lm_switch">
                    <div class="form-check form-switch ps-0 mb-2">
                      <div class="d-flex gap-5 align-items-center justify-content-between"><label
                        class="form-check-label title-font mb-0" id="on-off" for="flexSwitchCheckChecked1">On
                        </label><input class="form-check-input on-off" id="flexSwitchCheckChecked1" type="checkbox"
                          role="switch" checked="">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-center btn-saved">
                  <a class="btn btn--primary" href="{{ route('admin.course.edit') }}">Save</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

@endsection