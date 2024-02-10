@foreach ($courses as $course)
    <div class="col-md-6">
        <div class="lm_course-card card border-0 shadow">
        <div class="card-img position-relative">
            <img src="{{ $course['course_thumbnail'] }}" alt="" height="400px" width="500px">
            
            @if($course['course_price_type']=="paid")
                @if ($course['course_purchase_status'] == '1')
                <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                    class="fw-normal badge bg-green text-sm-16 rounded-4 title-font"> Purchased</span>
                </div>
                @else
                <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                    class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font"> {{ '$'.$course['course_price'].' AUD' ??  ''}}</span>
                </div>
                @endif
            @endif
            
            @if($course['course_price_type']=="free")
            <div class="position-absolute top-0 end-0 mt-2 me-2"><span
                class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font"> Free</span>
            </div>
            @endif
            
            
            <!-- <div class="position-absolute top-0 end-0 mt-2 me-2"><span class="fw-normal badge bg-primary text-sm-16 rounded-4 title-font d-flex gap-1">Host <span>
                <img class="in-svg" src="{{asset('assets/images/crown.svg')}}" alt=""></span></span>
            </div> -->
        </div>
        <div class="card-body px-0 pb-0">
            <div class="d-flex align-items-center gap-2 mb-2 justify-content-between">
            <h4 class="mb-0"> <a class="text-dark" href="{{ route('user.courses.view', ['id' => $course['id']]) }}">{{ $course['course_name'] }}</a></h4>
            {{-- Featured Post Status Update --}}
            @if(Auth::user()->is_admin == 1)
            <div class="dropdown mt-1"><a
                class="dropdown-toggle" type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"><span><img
                        class="in-svg"
                        src="{{asset('assets/images/dots-1.svg')}}"
                        alt=""></span></a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item toggleFeaturedCourse" is-featured-course="{{ $course['is_featured'] ? 0 : 1 }}" data-id-fetured-course="{{$course['id']}}"> {{ $course['is_featured'] ? 'Unfeature' : 'Feature' }} Course</a>
                    <input type="hidden" id="save_type" value="1"/>
                </li>
                <li> <a class="dropdown-item" onclick="GetDeletModal({{ $course['id'] }})">Delete Course</a></li>
                </ul>
            </div>
            @endif
            <!-- <span class="fw-normal badge bg-primary d-flex gap-1"><img class="in-svg" src="{{asset('assets/images/badge.svg')}}" alt="">Premium</span> -->
            </div>
            <p class="mb-2">
                {!! strip_tags($course['description']) !!}
                
                {{-- {!! str_limit(strip_tags($course['description']), $limit = 50, $end = '...') !!} --}}
                
            </p>
            
            <div class="d-flex align-items-end justify-content-between">
            <div class="d-block">
                <span class="text-dark title-font">Coaches</span>
                <a class="avtar-group mt-1">
                
                
                @foreach ($course['coaches'] as $coach)
                <div class="avtar-55" onclick="ViewMemberProfile({{ $coach->id }})"><img src="{{ $coach->profile_image_url ?? asset('assets/images/ev1.jpg')}}" ></div>
                @endforeach
                </a>
            </div>
            <div class="d-flex gap-2">
                
            @if(Auth::user()->is_admin==1)
                <div class="lm__hover">
                <div class="d-flex gap-2">
                    <span data-bs-toggle="tooltip" data-bs-original-title="View Course"><a href="{{ route('user.courses.view', ['id' => $course['id']]) }}"> <img class="in-svg" src="{{asset('assets/images/eye.svg')}}" alt=""></a></span>
                    <span data-bs-toggle="tooltip" data-bs-original-title="Share The Course"> <a onclick="OpenShareCourseModal('{{ route('user.courses.view', ['id' => $course['id']]) }}')"> <img class="in-svg" src="{{asset('assets/images/share.svg')}}" alt=""></a></span>
                    {{-- href={{ $course['download_pdf'] }}" download="{{ $course['download_pdf'] }}" --}}
                    <span data-bs-toggle="tooltip" data-bs-original-title="Download PDF Brochure"><a href="{{ $course['upload_pdf'] }}" download="{{ $course['upload_pdf']}}"><img class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span>
                    <span data-bs-toggle="tooltip" data-bs-original-title="Edit Course Overview"><a href="{{ route('admin.course.edit', ['id' => $course['id']]) }}"> <img class="in-svg" src="{{asset('assets/images/pen.svg')}}" alt=""></a></span>
                </div>
                </div>
            @else
                <div class="lm__hover">
                <div class="d-flex gap-2">
                    {{-- <span>
                    <a href="{{ route('user.courses.view', ['id' => $course['id']]) }}"> <img class="in-svg" src="{{asset('assets/images/eye.svg')}}" alt=""></a>
                    </span> --}}
                    <span data-bs-toggle="tooltip" data-bs-original-title="Share The Course"><a onclick="OpenShareCourseModal('{{ route('user.courses.view', ['id' => $course['id']]) }}')">
                    <img class="in-svg" src="{{asset('assets/images/share.svg')}}" alt="">
                    </a>
                    </span>
                    <span data-bs-toggle="tooltip" data-bs-original-title="Download PDF Brochure"><a href="{{ $course['upload_pdf'] }}" download="{{ $course['upload_pdf']}}" target="_blank"> <img class="in-svg" src="{{asset('assets/images/download.svg')}}" alt=""></a></span> 
                </div>
                </div>
            @endif
                
                <div class="d-block">
                @if(Auth::user()->is_admin==1)
                <a class="btn btn--dark-lenear py-2 text-sm-18" href="{{ route('admin.courses.inner' , ['id' => $course['id']]) }}">Manage Modules</a>
                @else
                    {{-- @if($course['course_price_type']=="paid" && $course['course_purchase_status']==0)
                    <a class="btn btn--dark-lenear text-primary py-2" href="{{ route('user.courses.buy' , ['id' => $course['id']]) }}">Buy</a>
                    @else --}}
                    <a class="btn btn--dark-lenear py-2 text-sm-18" href="{{ route('user.courses.view', ['id' => $course['id']]) }}">View Course</a>
                    {{-- @endif --}}
                @endif
                
                </div>
            </div>
            </div>                     
            
        </div>
        </div>

        {{-- Delete Course Modal --}}
        <div class="modal fade" id="DeleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered lm__modal-4">
                <input type="hidden" id="delete_course_id">
                <div class="modal-content overflow-hidden">
                    <div class="modal-body p-4 text-center position-relative">
                        <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                                        alt=""></span></button></div>
                        <div class="z-index-1 position-relative lm_mxw50">
                            <h4 class="text-white">Are you sure you want to delete this course?</h4><button
                                class="btn btn--danger mt-3 title-font rounded-2 py-2" onclick="delete_course()">Delete</button><button
                                class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endforeach

<script type="text/javascript">
    $(function() {
        $('[data-bs-toggle="tooltip"]').hover(function () {
            var tooltipTitle = $(this).attr('data-bs-original-title');
            $(this).attr('title', '');
            $(this).tooltip({ title: tooltipTitle }).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });
    
    jQuery('.in-svg').each(function(i, e) {
        var $img = jQuery(e);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
        jQuery.get(imgURL, function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find('svg');
        // Add replaced image's ID to the new SVG
        if (typeof imgID !== 'undefined') {
            $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if (typeof imgClass !== 'undefined') {
            $svg = $svg.attr('class', ' ' + imgClass + ' replaced-svg');
        }
        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');
        // Replace image with new SVG
        $img.replaceWith($svg);
        }, 'xml');
    });

    $(".toggleFeaturedCourse").click(function(e) {
        e.preventDefault();
        var course_id = $(this).attr("data-id-fetured-course");
        // var is_featured = $(this).attr("is-featured-course");

        let url = '{{ route("courses.featured.course.status.update", ":id") }}';
        url = url.replace(':id', course_id);

        // formData = '';
        $.ajax({
            url: url
            , type: "POST"
            , headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            , data: {
                // id: course_id,
                // is_featured: is_featured,
            }
            , dataType: 'JSON'            
            , contentType: false
            , processData: false 
            , success: function(data) {
            
                if (data.error) {
                    return false;
                } else if (data.status == "200") {
                    var success_message = data.message;                                    
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: success_message ,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    // window.location.reload();
                    getCourseLists();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                            
                var errorMessage = (jqXHR.responseJSON && jqXHR.responseJSON.message) ? jqXHR.responseJSON.message : "An error occurred: " + errorThrown;
                $('#errorField').text(jqXHR.responseJSON.message);
                console.log(jqXHR.responseJSON.message);
            }
        });
    });

    function GetDeletModal(delete_course_id)
    {
        $("#delete_course_id").val(delete_course_id);
        $('#DeleteCourseModal').modal('show');
    }

    function delete_course() {
        let _token = $("input[name=_token]").val();
        var id = $("#delete_course_id").val();
        let url = '{{ route("admin.course.delete", ":id") }}';
        url = url.replace(':id', id);
    
        $.ajax({
            url: url
            , method: "delete"
            , data: {
                _token: _token
                , id: id
            }
        }).done(function(data) {
                                
            if (data.error)
            {
                var error_message = data.message;                                    
                Swal.fire({
                    toast: true,
                    icon: 'warning',
                    title: error_message ,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: false,
                    // footer: '<a href="">Click to open</a>',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                }); 
                
                return false;
                        
            } else if (data.status == "200") {
                var success_message = data.message;                                    
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: success_message ,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    // footer: '<a href="">Click to open</a>',
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });  
                // window.location.reload();   
                getCourseLists('all',1);                      
            }
                    
            $("#delete_course_id").val('');
            $('#DeleteCourseModal').modal('hide');
            $('.modal-backdrop').remove(); // Remove the modal backdrop
            $('body').removeClass('modal-open'); // Remove the 'modal-open' class from the body           
            
        });
    }
</script>