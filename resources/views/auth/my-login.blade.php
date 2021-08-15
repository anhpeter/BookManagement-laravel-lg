@extends('layouts.auth')

@section('content')

    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Enter Email Address..." autofocus autocomplete="email" value="{{ old('email') }}"
                    required>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password" value="{{ old('password') }}" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">Remember Me</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Login </button>
            <hr>
            <a href="index.html" class="btn btn-google btn-user btn-block">
                <i class="fab fa-google fa-fw"></i> Login with Google
            </a>
            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
            </a>
        </form>
        <hr>
        <div class="text-center">
            @if (Route::has('password.request'))
                <a class="small" href="{{ route('password.request') }}"> Forgot Password? </a>
            @endif
        </div>
        <div class="text-center">
            <a class="small" href="register.html">Create an Account!</a>
        </div>
    </div>

@endsection
