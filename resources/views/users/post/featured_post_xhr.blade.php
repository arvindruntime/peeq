
@foreach ($posts['data'] as $post)
    @if ($post['is_featured'] == 1)
        @if ($post['post_type'] == 'post' || $post['post_type'] == 'article')
            <div class="swiper-slide">
                <a class="card border-0 shadow h-100" onclick="getPostdetail({{ $post['id'] }})">
                    <div class="d-flex gap-2 align-items-center mb-2">
                        @if(isset($post['user']) && is_array($post['user']))
                        <div class="lm_card-post-logo"><span class="shadow p-0"><img
                                    class="in-svg rounded-circle object-fit-cover" style="height:100%; width:100%;"
                                    src="{{ $post['user']['profile_image_url'] ?? ''}}" alt=""></span></div>
                        <div class="d-lnline text-start">
                            <h6 class="mb-1">{{ $post['user']['first_name'] ?? ''}} {{ $post['user']['last_name'] ?? ''}}</h6>
                        </div>
                        @endif
                    </div>
                    <div class="card-body p-0">

                        @php
                            preg_match_all('/<img[^>]+>/i', $post['content'], $result);
                            if (isset($result[0][0])) {
                                echo $result[0][0];
                            } else {
                                preg_match_all('/<video[^>]+>/i', $post['content'], $result1);
                                if (isset($result1[0][0])) {
                                    echo $result1[0][0];
                                } else {
                                    echo $post['content'];
                                }
                            }
                        @endphp


                    </div>
                </a>
            </div>
        @elseif($post['post_type'] == 'poll_question')
            <div class="swiper-slide">
                <a class="card border-0 shadow h-100" onclick="getPostdetail({{ $post['id'] }})">
                    <div class="d-flex gap-2 align-items-center mb-3">
                        @if(isset($post['user']) && is_array($post['user']))
                        <div class="lm_card-post-logo">
                            <span class="shadow p-0">
                                <img class="in-svg rounded-circle object-fit-cover" style="height:100%; width:100%;"
                                    src="{{ $post['user']['profile_image_url'] ?? ''}}" alt="">
                            </span>
                        </div>
                        <div class="d-lnline text-start">
                            <h6 class="mb-1">{{ $post['user']['first_name'] ?? ''}} {{ $post['user']['last_name'] ?? ''}}</h6>
                        </div>
                        @endif
                    </div>
                    <div
                        class="card-body bg-primary p-2 rounded-2 text-center d-flex h-100 align-center justify-content-center">
                        <div>
                            <p class="text-sm-14 fw-bold my-1 text-dark lh-base">{!! $post['content'] !!}</p>
                            <button class="btn btn--dark py-2 rounded-2 mt-3">Share your answer</button>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endif
@endforeach

<script>
    $(document).ready(function(){
        var swiper = new Swiper('.mySwiper-post', {
        slidesPerView: "1",
        spaceBetween: 20,
        grabCursor: true,
        //   loop: true,
        //     autoplay: {
        //         delay: 0,
        //     },
        //     speed: 11000,          //add
        //     slidesPerView: 3,     //add
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
                992: {
                slidesPerView: 2,
                spaceBetween: 10,
                },
                768: {
                slidesPerView: 2,
                spaceBetween: 10,
                },
                375: {
                slidesPerView: 2,
                spaceBetween: 10,
                },
            },
        });
    });
  </script>
