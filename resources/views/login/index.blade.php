@extends('layout.login.main')

@section('title', 'login')
@section('content')

    <!--begin::Form-->
    <form action="{{ route('login.authenticate') }}" method="post">
        @csrf
        <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            @if ($errors->has('username'))
                <small class="text-danger">{{ $errors->first('username') }}</small>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
                <small class="text-danger">{{ $errors->first('password') }}</small>
            @endif
        </div>
        @if (session('incorect'))
            <div class="alert alert-danger">
                {{ session('incorect') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xs-8">
                <!-- Optional: Add "Remember Me" or other links here -->
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
        </div>
    </form>

    <!--end::Form-->
@endsection
