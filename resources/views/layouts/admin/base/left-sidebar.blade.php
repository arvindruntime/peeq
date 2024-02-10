
<style>
  .disabled {
      pointer-events: none;
      opacity: 0.5; /* You can adjust the opacity to visually indicate that the content is disabled */
  }
</style>
@php
$request['is_mobile'] = 0;
$welcome_checklist = welcomeChecklists($request);
$disabled = "";
if($welcome_checklist['welcome_checklist_complete']<1)
{
    $disabled = "disabled";
}
@endphp 
<aside class="lm__dash auto-load">
  <div class="aside-colse"><span><img class="in-svg" src="{{ asset('assets/images/gridicons_cross.svg') }}"></span></div>
  <div class="lm__dash-wrapper"> 
    <div class="lm__dash-logo"><img class="light-logo" src="{{asset('assets/images/dash-logo.svg')}}"><img class="dark-logo" src="{{asset('assets/images/logo.svg')}}"></a></div>
    <ul class="lm__dash-menu {{  $disabled }}">      
      @if(session()->get('welcome_checklist')==0)
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('dashboard') ? 'active' : '') }}" href="{{ route('dashboard') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/home.svg') }}" alt=""></span><span class="menu-items">Welcome Check List</span></a>
      @endif
        {{-- <ul class="dropdown-menu lm__show mt-3">
          <li><a class="dropdown-item" href="#">Menu item</a></li>
          <li><a class="dropdown-item" href="#">Menu item</a></li>
          <li><a class="dropdown-item" href="#">Menu item</a></li>
        </ul> --}}
      </li>
      @if(session()->get('welcome_checklist')==1)
      @if($user->is_admin == 1)
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.dashboard') ? 'active' : '') }}" href="{{ route('admin.dashboard') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/admin-dashboard.svg') }}" alt=""></span><span class="menu-items">Dashboard</span></a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.users.index') ? 'active' : '') }}" href="{{ route('admin.users.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/member.svg') }}" alt=""></span><span class="menu-items">Users</span></a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.plans.index') ? 'active' : '') }}" href="{{ route('admin.plans.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/plan.svg') }}" alt=""></span><span class="menu-items">Plans</span></a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.emailTemplates.index') ? 'active' : '') }}" href="{{ route('admin.emailTemplates.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/email.svg') }}" alt=""></span><span class="menu-items">Email Template</span></a></li>
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.index') ? 'active' : '') }}" href="{{ route('admin.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/admin.svg') }}" alt=""></span>Admins</a></li> --}}
      @endif
      {{-- @php      
        $request['is_mobile'] = 0;
        $welcome_checklist = welcomeChecklists($request);        
      @endphp
      @if($welcome_checklist['welcome_checklist_complete']==1) --}}
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('posts.index') ? 'active' : '') }}" href="{{ route('posts.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/master.svg') }}" alt=""></span><span class="menu-items">PEEQ Network</span></a></li>
      {{-- @endif --}}
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('member.list') ? 'active' : '') }}" href="{{ route('member.list') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/member.svg') }}" alt=""></span><span class="menu-items">Members</span></a></li>
      @if(Auth::user()->is_admin==1)
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('events.create') ? 'active' : '') }}" href="{{ route('events.create') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/event.svg') }}" alt=""></span>Add Event</a></li> --}}
      @endif
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('events.index') ? 'active' : '') }}" href="{{ route('events.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/event.svg') }}" alt=""></span>Webinars & Events</a>
      
      </li> --}}
      <li class="lm__dash-menu-item mb-3">
        <a class="d-flex justify-content-between p-2 rounded-2 {{ (request()->routeIs('events.index') ? 'active' : '') }}" type="button"
          data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"><span class="d-flex"> 
            <img class="in-svg me-2" src="{{ asset('assets/images/event.svg') }}" alt=""><span class="menu-items">Events</span></span> <span class="sub-icon"><img class="in-svg" src="{{ asset('assets/images/sub-down.svg') }}" alt=""></span></a>
        <ul class="dropdown-menu lm__show mt-3">
          <li><a class="dropdown-item" href="{{ route('events.index') }}">Webinars & Events</a></li>
          
          @if(Auth::user()->is_admin==1)
          <li><a class="dropdown-item" href="{{ route('event.saved.draft') }}">Draft Events</a></li>
          @endif
      
          <li><a class="dropdown-item" href="{{ route('events.calendar') }}">Events Calendar</a></li>
          {{-- <li><a class="dropdown-item" href="#">Menu item</a></li> --}}
        </ul>
      </li>
      
      @if(Auth::user()->is_admin==1)
      <li class="lm__dash-menu-item mb-3">
        <a class="d-flex justify-content-between p-2 rounded-2 {{ (request()->routeIs('admin.courses.index') ? 'active' : '') }}" type="button"
          data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"><span class="d-flex"> 
            <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""><span class="menu-items">PEEQ Courses</span></span> <span class="sub-icon"><img class="in-svg" src="{{ asset('assets/images/sub-down.svg') }}" alt=""></span></a>
        <ul class="dropdown-menu lm__show mt-3">
         
          <li><a class="dropdown-item" href="{{ route('admin.courses.index') }}">Add Course</a></li>
          <li><a class="dropdown-item" href="{{ route('user.courses.list') }}">View Courses</a></li>
          
        </ul>
      </li>
      
      <li class="lm__dash-menu-item mb-3">
        <a class="d-flex justify-content-between p-2 rounded-2 {{ (request()->routeIs('web.admin.session.index') ? 'active' : '') }}" type="button"
          data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"><span class="d-flex"> 
            <img class="in-svg me-2 sess" src="{{ asset('assets/images/session.svg') }}" alt=""><span class="menu-items">1:1 Coaching Sessions</span></span> <span class="sub-icon"><img class="in-svg" src="{{ asset('assets/images/sub-down.svg') }}" alt=""></span></a>
        <ul class="dropdown-menu lm__show mt-3">
         
          <li><a class="dropdown-item" href="{{ route('web.admin.session.index') }}">Add Session</a></li>
          <li><a class="dropdown-item" href="{{ route('admin.session.list') }}">View Session</a></li>
          
        </ul>
      </li>
      
      @else
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('user.courses.list') ? 'active' : '') }}" href="{{ route('user.courses.list') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""></span><span class="menu-items">PEEQ Courses</span></a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.session.list') ? 'active' : '') }}" href="{{ route('admin.session.list') }}"><span> <img class="in-svg me-2 sess" src="{{ asset('assets/images/session.svg') }}" alt=""></span>1:1 Coaching Sessions</a></li>
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('enter.pin.page') ? 'active' : '') }}" href="{{ route('enter.pin.page') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""></span>PEEQ Courses</a></li> --}}
      @endif
      
      
      
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('events.calendar') ? 'active' : '') }}" href="{{ route('events.calendar') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/event.svg') }}" alt=""></span>Events Calendar</a></li>
      @if($user->is_admin == 0)
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('user.courses.index') ? 'active' : '') }}" href="{{ route('user.courses.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""></span>PEEQ Courses</a></li>
      @endif --}}
      @if($user->is_admin == 1)
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2 {{ (request()->routeIs('admin.courses.index') ? 'active' : '') }}" href="{{ route('admin.courses.index') }}"><span> <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""></span>PEEQ Courses</a></li> --}}
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2" href="#"><span> <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""></span>Courses</a></li> --}}
      @endif
      {{-- <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2" href="#"><span> <img class="in-svg me-2" src="{{ asset('assets/images/about.svg') }}" alt=""></span>About</a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2" href="#"><span> <img class="in-svg me-2" src="{{ asset('assets/images/invite.svg') }}" alt=""></span>Invite</a></li>
      <hr>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2" href="#"><span> <img class="in-svg me-2" src="{{ asset('assets/images/group.svg') }}" alt=""></span>Groups</a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2" href="#"><span> <img class="in-svg me-2" src="{{ asset('assets/images/cousre.svg') }}" alt=""></span>Courses</a></li>
      <li class="lm__dash-menu-item mb-3"><a class="d-flex p-2 rounded-2" href="#"><span> <img class="in-svg me-2" src="{{ asset('assets/images/master.svg') }}" alt=""></span>Master Class</a></li>
      <hr>
      <li class="lm__dash-menu-item mb-3"><a class="p-2 rounded-2 d-block" href="#">Thoughts From Zoe</a></li>
      <li class="lm__dash-menu-item mb-3"><a class="p-2 rounded-2 d-block" href="#">Master Class</a></li> --}}
      @endif
    </ul>
    
    @if($user->is_admin == 0)
    <div class="lm_dash-logout {{ $disabled }}"> <a class="d-flex p-2 rounded-2 d-block" href="{{ route('contact.support') }}"><span> <img class="in-svg me-2"
      src="{{ asset('assets/images/contact.svg')}}" alt=""></span>Support</a>
    </div>
    @endif
  </div>
</aside>
