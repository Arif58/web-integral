@extends('web.layout-auth')
@section('title', 'Register Integral Education')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    <h3 class="title">Register</h3>
    <form class="max-width-auto" action="/register" method="POST">
        @csrf
        <div class="form-group">
            <input name="email" type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="email"/>
            @error('email')
                <span class="message-info">{{ $message }}</span>  
            @enderror
            {{-- <label>Email *</label> --}}
            {{-- <span class="focus-border"></span> --}}
        </div>

        <div class="form-group">
            <input name="username" type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="username">
            @error('username')
                <span class="message-info">{{ $message }}</span>
            @enderror
            {{-- <label>Username</label> --}}
            {{-- <span class="focus-border"></span> --}}
        </div>

        <div class="form-group">
            <input name="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="password">
            @error('password')
                <span class="message-info">{{ $message }}</span>
            @enderror
            {{-- <label>Password</label> --}}
            {{-- <span class="focus-border"></span> --}}
        </div>

        <div class="form-group">
            <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="confirm password">
            {{-- <label>Confirm Password</label> --}}
            {{-- <span class="focus-border"></span> --}}
        </div>

        <div class="form-submit-group">
            <button type="submit" class="rbt-btn btn-md bg-primary hover-icon-reverse w-100">
                <span class="icon-reverse-wrapper">
                    <span class="btn-text">Register</span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                </span>
            </button>
        </div>

    </form>
</div>
@endsection