<!--========= Footer START =========-->
<footer class="footer-section pt-4 pb-3">
    <div class="container">
      <div class="row pb-2 g-4 justify-content-between">
        <div class="col-12 col-lg-3 text-start">
          <div class="footer_brand-wrapper">
            <!-- Logo -->
            <div class="footer_brand mb-3">
              <img src="{{ asset('landing/assets/images/logo.svg')}}" alt="" style="height: 80px;">
            </div>
            <div class="d-flex flex-wrap gap-3">
              <div class="ply_store">
                <a href="https://play.google.com/store/apps/details?id=au.com.peeq&pli=1" target="_blank">
                  <img src="{{ asset('landing/assets/images/play.png')}}" alt="">
                </a>
              </div>
              <div class="app_store">
                <a href="https://apps.apple.com/us/app/peeq/id6458190160" target="_blank">
                  <img src="{{ asset('landing/assets/images/app.png')}}" alt="">
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 text-start">
          <div class="footer_link_wrapper d-flex justify-content-lg-center">
            <div>
              <h5 class="text-white fw-bold mb-0 pb-0">Useful Pages </h5>
              <ul class="list-group bg-transparent border-0">
                <li class="list-group-item"><a href="{{ route('landing.about')}}">About </a></li>
                <li class="list-group-item"><a href="{{ route('landing.contact')}}">Contact</a></li>
                <li class="list-group-item"><a href="#"></a></li>
                <li class="list-group-item"><a href="#"></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 text-start">
          <div class="d-flex justify-content-lg-end">
            <div class="d-flex footer_cotact">
              <div class="footer_link_wrapper">
                <h5 class="text-white fw-bold mb-2">Contact</h5>
                <ul class="list-unstyled list-group bg-transparent border-0">
                  <li class="list-group-item">
                    <span><a class="d-flex gap-2" href="mailto:support@peeq.com.au"><img src="{{ asset('landing/assets/images/mail.svg')}}"
                          alt="">support@peeq.com.au</a></span>
                  </li>
                </ul>
                <div class="footer_social mt-3">
                  <div class="d-flex gap-3 flex-wrap">
                    {{-- <a href="#" class="social-btn"><img src="{{ asset('landing/assets/images/fb-icon.png')}}" alt=""></a> --}}
                    <!-- <a href="#" class="social-btn"><img src="assets/images/insta-icon.png" alt=""></a> -->
                    <!-- <a href="#" class="social-btn"><img src="assets/images/youtube-icon.png" alt=""></a> -->
                    <!-- <a href="#" class="social-btn"><img src="assets/images/twitter-icon.png" alt=""></a> -->
                    <a href="https://www.linkedin.com/company/peeq-performance-elevation-through-eq/" class="social-btn" target="blank"><img src="{{ asset('landing/assets/images/linkedin-icon.png')}}" alt=""></a>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <hr class="border-light">
        </div>
        <div class="copy-right-sec">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="text-center text-md-start">
                <p class="text-white m-0">© {{ date('Y') }} PEEQ™ (Luminary Mindset™)</p>
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
              <div class="cr-content addres-cntnt d-flex justify-content-center justify-content-lg-end">
                <p><a href="{{ route('terms.conditions') }}" target="_blank">Terms of use</a></p>
                <p><a href="{{ route('privacy.policy') }}"  target="_blank">Privacy Policy</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--========= Footer END =========-->