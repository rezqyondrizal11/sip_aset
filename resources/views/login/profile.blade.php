@extends('layout.system.main')
@section('title', 'My Profile')
@section('content')

    <section class="content">

        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="{{ request()->routeIs('profile.profile') ? 'active' : '' }}">
                    <a href="#profile" data-toggle="tab">My Profile</a>
                </li>
                <li class="{{ request()->routeIs('profile.changepassword') ? 'active' : '' }}">
                    <a href="#password" data-toggle="tab">Change Password</a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Profile Tab -->
                <div class="tab-pane {{ request()->routeIs('profile.profile') ? 'active' : '' }}" id="profile">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('profile.updateprofile') }}">
                        @csrf
                        <!-- Name -->
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Name"
                                    value="{{ old('name', $data->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Username -->
                        <div class="form-group">
                            <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputUsername" name="username"
                                    placeholder="Username" value="{{ old('username', $data->username) }}">
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="email"
                                    placeholder="Email" value="{{ old('email', $data->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <!-- Submit Button -->
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>

                </div>

                <!-- Change Password Tab -->
                <div class="tab-pane {{ request()->routeIs('profile.changepassword') ? 'active' : '' }}" id="password">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <form class="form-horizontal" method="POST" action="{{ route('profile.updatechangepassword') }}">
                        @csrf
                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="currentPassword" class="col-sm-2 control-label">Current Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="currentPassword" name="current_password"
                                    placeholder="Current Password">
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="newPassword" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="newPassword" name="new_password"
                                    placeholder="New Password" value="{{ old('new_password') }}">
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="confirmPassword" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="confirmPassword"
                                    name="new_password_confirmation" placeholder="Confirm Password"
                                    value="{{ old('new_password_confirmation') }}">
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>


    </section>
    <!--begin::Post-->


@endsection
