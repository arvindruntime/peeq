@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
    <section class="lm__dash-con lm__course-list-admin">
        <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img class="dark"
                src="{{asset('assets/images/dark.png')}}" alt=""></span>
        <div class="container">
            {{-- <a href="{{route('user.courses.list')}}" class="d-flex align-items-center mb-3">
                <img class="in-svg mr-2" src="{{asset('assets/images/backto.svg')}}" alt="">
                <p class="fs-5 mb-0 text-black">Back to Course</p>
            </a> --}}
            <div class="mb-3">
                <a href="{{route('user.courses.list')}}" class="btn btn--primary rounded-4 py-2">Back to Course</a>
              </div>
            @if(isset($interactiveworkbook))
            <div class="row">
                <div class="col-12">
                    <div class="create-list-admin">
                        <div class="create-list-admin-title">
                            <h4 class="fw-bold text-primary mb-4">{{ $courseModule->title }}</h4>
                        </div>
                        @forelse ($interactiveworkbook as $key=>$item)
                        <div class="lm_card-post my-4">
                            <input type="hidden" name="delete_id" id="delete_id"value="{{$item->id}}">
                            <div class="card border-0 p-2 p-sm-3 ">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="d-lnline text-start">
                                            <h5 class="mb-1">{{"Page ".$item->page_no}}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 gap-sm-3">
                                            @if ($item->audio_file)
                                                <div class="audioshow{{$item->id}}">
                                                    <audio controls>
                                                        <source src="{{ $item->audio_file }}" type="audio/mpeg">
                                                        <source src="{{ $item->audio_file }}" type="audio/wav">
                                                        <source src="{{ $item->audio_file }}" type="audio/ogg">
                                                    </audio>
                                                </div>
                                            @endif
                                    {{-- <span class="eye-close bg-white-42 shadow"> 
                                        <img class="in-svg close" src="{{asset('assets/images/eye-off.svg')}}" alt="">
                                        <img class="in-svg open" src="{{asset('assets/images/eye-on.svg')}}" alt="">
                                    </span> --}}
                                        <div class="">
                                            <a href="{{route('admin.interactive.editor.workbook',['id'=>$item->id])}}" class="btn btn--dark py-2">Edit</a>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><span><img class="in-svg"
                                                        src="{{asset('assets/images/dots.svg')}}" alt=""></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('admin.interactive.view.workbook',['courseModule'=>$item->course_module_id, 'user' => $userId]) }}">Preview</a></li>
                                                <li>
                                                    {{-- <form action="{{ route('interactive.workbook.delete',['id'=>$item->id]) }}" method="post" onsubmit="return confirm('Want to delete this workbook')">
                                                        @method('DELETE')
                                                        @csrf --}}
                                                        <a class="dropdown-item" onclick="GetDeletModal({{ $item['id'] }})">Delete Page</a>
                                                    {{-- </form> --}}
                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            
                            
                        </div>   
                        @empty
                {{'No Record Found'}}
                @endforelse
            
                        {{-- <div class="lm_card-post my-4">
                            <div class="card border-0 p-2 p-sm-3 ">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="d-lnline text-start">
                                            <h5 class="mb-1">Page - 2</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 gap-sm-3">
                                    <span class="eye-close bg-white-42 shadow"> 
                                        <img class="in-svg close" src="{{asset('assets/images/eye-off.svg')}}" alt="">
                                        <img class="in-svg open" src="{{asset('assets/images/eye-on.svg')}}" alt="">
                                    </span>
                                    
                                        <div class="">
                                            <a href="{{ route('admin.interactive.editor.workbook')}}" class="btn btn--dark py-2">Edit</a>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false"><span><img class="in-svg"
                                                        src="{{asset('assets/images/dots.svg')}}" alt=""></span></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="">Preview</a></li>
                                                <li><a class="dropdown-item" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal9">Delete Page</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-12">
                    <div class="create-list-admin">
                        <a class="create_admin-course py-3" href="{{route('admin.interactive.add',['course_id'=>$course_id,'course_module_id'=>$course_module_id])}}">
                            <div class="create-course-btn text-primary gap-2"> <span> <img class="in-svg" src="{{asset('assets/images/plus-3.svg')}}" alt=""></span>Add Page</div>
                        </a>
                    </div>
                </div>  
            </div>
            @endif
        </div>

        {{-- Delete Course Modal --}}
        <div class="modal fade" id="DeleteInteractiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered lm__modal-4">
                <input type="hidden" id="delete_id">
                <div class="modal-content overflow-hidden">
                    <div class="modal-body p-4 text-center position-relative">
                        <div class="modal-header p-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"><span> <img class="in-svg" src="{{asset('assets/images/close.svg')}}"
                                        alt=""></span></button></div>
                        <div class="z-index-1 position-relative lm_mxw50">
                            <h4 class="text-white">Are you sure you want to delete this interactive workbook page?</h4><button
                                class="btn btn--danger mt-3 title-font rounded-2 py-2" onclick="delete_interactive()">Delete</button><button
                                class="btn-close text-white d-block w-100 mt-2 title-font" type="button" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
    </section>
</main>
<script>
    function GetDeletModal(delete_id)
    {
        $("#delete_id").val(delete_id);
        $('#DeleteInteractiveModal').modal('show');
    }

    function delete_interactive() {
        let _token =  $('meta[name="csrf-token"]').attr('content');
        var id = $("#delete_id").val();
        let url = '{{ route("interactive.workbook.delete", ":id") }}';
        url = url.replace(':id',id);
        
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
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });     
                window.location.reload();
            }
  
            $("#delete_id").val('');
            $('#DeleteInteractiveModal').modal('hide');
            $('.modal-backdrop').remove(); // Remove the modal backdrop
            $('body').removeClass('modal-open'); // Remove the 'modal-open' class from the body           
            
        });
    }
</script>
@endsection