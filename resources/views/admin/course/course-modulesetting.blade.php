@extends('layouts.admin.master')
@section('content')

<main class="main-content" id="main">
  <section class="lm__dash-con mb-5 lm__module-overview">
  <span class="lm_vec"><img class="light"
      src="{{asset('assets/images/light.png')}}" alt=""><img class="dark" src="{{asset('assets/images/dark.png')}}" alt=""></span>
    <div class="container">
      <div class="row lm__module-overview">
        <div class="col-12">
          <div class="lm__module-overview-con">
            <div class="lm__module-title-btn">
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="text-primary fw-semibold mb-0">Module Settings</h4>
                <a class="btn btn--primary" href="{{ route('admin.course.edit') }}">Edit module</a>
              </div>
            </div>
            <div class="lm__overview-card card shadow">
              <div class="lm__overview-inner">
                <h5 class="fw-bold mb-2">Visibility</h5>
                <p class="mb-0">When you make this Module “Visible,” the following things will become visible to
                  Members: the Module title, the first few lines of the body, and the thumbnail image. The ability for
                  Members to open and view the Section depends on the “Unlock Options,” which you can set below. Also
                  note that the privacy level of the Course will also determine who can see the Course and its Visible
                  contents.
                </p>
                <div class="lm_on-off shadow my-3">
                  <div class="lm_switch">
                    <div class="form-check form-switch ps-0 mb-2">
                      <div class="d-flex gap-5 align-items-center justify-content-between"><label
                        class="form-check-label title-font mb-0" id="visible-hidden"
                        for="flexSwitchCheckDefault">Visible</label><input class="form-check-input visible-hidden"
                        id="flexSwitchCheckDefault" type="checkbox" role="switch" checked=""></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="lm__overview-inner">
                <h5 class="fw-bold">Unlock Options</h5>
                <div class="d-block lm_unlock">
                  <div class="form-check d-flex gap-2">
                    <input class="form-check-input" id="flexRadioDefaultc3"
                      type="radio" name="flexRadioDefault1">
                    <label
                      class="form-check-label d-block w-100 mb-0 h6 text-secondary fw-normal"
                      for="flexRadioDefaultc3">
                      <div class="d-block">
                        <h6 class="mb-1 fw-bold">None</h6>
                        <p class="mb-0">Module will be unlocked and all Members will have access.</p>
                      </div>
                    </label>
                  </div>
                  <div class="form-check d-flex gap-2">
                    <input class="form-check-input mb-0" id="flexRadioDefaultc4"
                      type="radio" name="flexRadioDefault1">
                    <label
                      class="form-check-label d-block w-100 h6 text-secondary fw-normal" for="flexRadioDefaultc4">
                      <div class="d-block">
                        <h6 class="mb-1 fw-bold">Sequential</h6>
                        <p class="mb-0">Module will unlock immediately after the previous Section is completed.</p>
                      </div>
                    </label>
                  </div>
                  <div class="form-check d-flex gap-2">
                    <input class="form-check-input mb-0" id="flexRadioDefaultc5"
                      type="radio" name="flexRadioDefault1">
                    <label
                      class="form-check-label d-block w-100 h6 text-secondary fw-normal" for="flexRadioDefaultc5">
                      <div class="d-block">
                        <h6 class="mb-1 fw-bold">Timed</h6>
                        <p class="mb-0">Module will unlock at a specific time after a Member begins the Course.</p>
                      </div>
                    </label>
                  </div>
                </div>
              </div>
              <h5 class="fw-bold">Completion Options</h5>
              <div class="d-block lm_unlock">
                <div class="form-check d-flex gap-2">
                  <input class="form-check-input" id="flexRadioDefaultc7"
                    type="radio" name="flexRadioDefault1">
                  <label
                    class="form-check-label d-block w-100 mb-0 h6 text-secondary fw-normal" for="flexRadioDefaultc6">
                    <div class="d-block">
                      <h6 class="mb-1 fw-bold">None</h6>
                      <p class="mb-0">Completion of this Module will not be tracked.</p>
                    </div>
                  </label>
                </div>
                <div class="form-check d-flex gap-2">
                  <input class="form-check-input mb-0" id="flexRadioDefaultc7"
                    type="radio" name="flexRadioDefault1">
                  <label
                    class="form-check-label d-block w-100 h6 text-secondary fw-normal" for="flexRadioDefaultc7">
                    <div class="d-block">
                      <h6 class="mb-1 fw-bold">Visited</h6>
                      <p class="mb-0">Members must visit this Module to complete it.</p>
                    </div>
                  </label>
                </div>
                <div class="form-check d-flex gap-2">
                  <input class="form-check-input mb-0" id="flexRadioDefaultc8"
                    type="radio" name="flexRadioDefault1">
                  <label
                    class="form-check-label d-block w-100 h6 text-secondary fw-normal" for="flexRadioDefaultc8">
                    <div class="d-block">
                      <h6 class="mb-1 fw-bold">Button</h6>
                      <p class="mb-0">Members must click a “Mark as Complete” button, that will appear at the bottom
                        of the Module, to complete it.
                      </p>
                    </div>
                  </label>
                </div>
                <div class="form-check d-flex gap-2">
                  <input class="form-check-input mb-0" id="flexRadioDefaultc8"
                    type="radio" name="flexRadioDefault1">
                  <label
                    class="form-check-label d-block w-100 h6 text-secondary fw-normal" for="flexRadioDefaultc8">
                    <div class="d-block">
                      <h6 class="mb-1 fw-bold">Video</h6>
                      <p class="mb-0">Members must watch the tracked video in this Module in order to complete it.</p>
                    </div>
                  </label>
                </div>
              </div>
              <!-- <div class="lm_on-off shadow my-3">
                <div class="lm_switch">
                  <div class="form-check form-switch ps-0 mb-2">
                    <div class="d-flex gap-5 align-items-center justify-content-between"><label
                      class="form-check-label title-font mb-0" id="on-off" for="flexSwitchCheckChecked1">On
                      </label><input class="form-check-input on-off" id="flexSwitchCheckChecked1" type="checkbox"
                        role="switch" checked="">
                    </div>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="d-flex justify-content-center btn-saved">
              <div class="btn btn--primary">Save</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

@endsection