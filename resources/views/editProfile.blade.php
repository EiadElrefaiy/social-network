@extends('layouts.app')

@section('content')
<div class="col-lg-1"></div>
<div class="col-lg-10">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="iq-edit-list">
                            <ul class="iq-edit-profile row nav nav-pills">
                                <li class="col-md-6 p-0">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#personal-information">
                                        Personal Information
                                    </a>
                                </li>
                                <li class="col-md-6 p-0">
                                    <a class="nav-link" data-bs-toggle="pill" href="#chang-pwd">
                                        Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<div class="col-lg-1"></div>

    <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="iq-edit-list-data">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                <form method="POST" action="{{ route('update.profile', ['user' => auth()->user()->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row align-items-center">
                                            <div class="col-md-12 text-center">
                                                <div class="profile-img-edit">
                                                    @if (auth()->user()->image)
                                                        <img style="object-fit: fill;" class="profile-pic" src="{{ asset('storage/images/users/' . auth()->user()->image) }}" alt="profile-pic">
                                                        @else
                                                        <img style="object-fit: fill;" class="profile-pic" src="{{URL::asset('assets/images/user/default.jpg')}}" alt="profile-pic">
                                                    @endif
                                                    <div class="p-image">
                                                        <i class="ri-pencil-line upload-button text-white"></i>
                                                        <input name="image" class="file-upload" type="file" accept="image/*"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-6">
                                                <label for="uname" class="form-label">User Name:</label>
                                                <input type="text" class="form-control" name="name" id="uname" placeholder="name" value="{{auth()->user()->name}}" required>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label for="lname" class="form-label">Email:</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{auth()->user()->email}}" required>
                                            </div>
                                            <div class="form-group col-sm-12">
                                                <label class="form-label">Bio:</label>
                                                <input class="form-control" id="bio" name="bio" value="{{auth()->user()->bio}}" style="line-height: 22px;">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button type="reset" class="btn bg-soft-danger">Cancle</button>
                                    </form>
                                    @if(Session::has('success'))
                                        <div class="alert alert-success mt-3">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Change Password</h4>
                                </div>
                                </div>
                                <div class="card-body">
                                <form method="POST" action="{{ route('update.password', ['user' => auth()->user()->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                            <label for="cpass" class="form-label">Current Password:</label>
                                            <a href="#" class="float-end">Forgot Password</a>
                                            <input name="old_password" type="Password" class="form-control" id="cpass" value="">
                                            @error('old_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="npass" class="form-label">New Password:</label>
                                            <input name="password" type="Password" class="form-control" id="npass" value="">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="vpass" class="form-label">Verify Password:</label>
                                            <input name="password_confirmation" type="Password" class="form-control" id="vpass" value="">
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button type="reset" class="btn bg-soft-danger">Cancle</button>
                                    </form>
                                    @if(Session::has('success'))
                                        <div class="alert alert-success mt-3">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>

@endsection