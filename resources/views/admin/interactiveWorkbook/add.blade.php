@extends('layouts.admin.master')
@section('content')
<main class="main-content" id="main">
    <section class="lm__dash-con lm__course-list-admin">
        <span class="lm_vec"><img class="light" src="{{asset('assets/images/light.png')}}" alt=""><img class="dark"
                src="{{asset('assets/images/dark.png')}}" alt=""></span>
        <div class="container">
            <a href="{{route('admin.interactive.list.workbook',['courseModule'=>$course_module_id])}}" class="d-flex align-items-center mb-3">
                <img class="in-svg mr-2" src="{{asset('assets/images/backto.svg')}}" alt="">
                <p class="fs-5 mb-0 text-black">Back to Course</p>
            </a>
            <div class="row">
                <div class="col-12">
                    <div class="create-list-admin">
                        <div class="create-list-admin-title">
                            <h4 class="fw-bold text-primary mb-4">How To Get The Most Out Of This Program</h4>
                        </div>
                        <div class="">
                            <a class="create_admin-course" href="{{route('admin.interactive.add',['course_id'=>$course_id,'course_module_id'=>$course_module_id])}}">
                                <div class="create-course-btn text-primary gap-2"> <span> <img class="in-svg" src="{{asset('assets/images/plus-3.svg')}}" alt=""></span>Add Page</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
    
@endsection