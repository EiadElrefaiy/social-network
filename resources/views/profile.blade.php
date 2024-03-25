@extends('layouts.app')

@section('content')
<div class="col-sm-2">

</div>
<div class="col-sm-8">
         <div class="card">
            <div class="card-body profile-page p-0">
               <div class="profile-header">
                  <div class="position-relative" style="visibility: hidden; height: 120px;" >
                     <ul class="header-nav list-inline d-flex flex-wrap justify-end p-0 m-0">
                        <li><a href="#"><i class="ri-pencil-line"></i></a></li>
                        <li><a href="#"><i class="ri-settings-4-line"></i></a></li>
                     </ul>
                  </div>
                  <div class="user-detail text-center mb-3">
                     <div class="profile-img">
                     @if ($user->image)
                              <img src="{{ asset('storage/images/users/' . $user->image) }}" alt="profile-img" class="avatar-130 img-fluid" />
                              @else
                              <img src="{{URL::asset('assets/images/user/default.jpg')}}" alt="profile-img" class="avatar-130 img-fluid" />
                      @endif
                     </div>
                     <div class="profile-detail">
                        <h3 class="">{{$user->name}}</h3>
                     </div>
                  </div>
                  <div class="profile-info p-3 d-flex align-items-center justify-content-between position-relative">
                     <div class="social-links">
                     </div>
                     <div class="social-info">
                        <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                           <li class="text-center ps-3">
                              <h6>Posts</h6>
                              <p class="mb-0">{{$user->posts->count()}}</p>
                           </li>
                           <li class="text-center ps-3">
                              <h6>Friends</h6>
                              <p class="mb-0">{{$user->friends->count() }}</p>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-body p-0">
               <div class="user-tabing">
                  <ul class="nav nav-pills d-flex align-items-center justify-content-center profile-feed-items p-0 m-0">
                     <li class="nav-item col-12 col-sm-6 p-0">
                        <a class="nav-link active" href="#pills-timeline-tab" data-bs-toggle="pill" data-bs-target="#timeline" role="button">Timeline</a>
                     </li>
                     <li class="nav-item col-12 col-sm-6 p-0">
                        <a class="nav-link" href="#pills-friends-tab" data-bs-toggle="pill" data-bs-target="#friends" role="button">Friends</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>

      
@endsection