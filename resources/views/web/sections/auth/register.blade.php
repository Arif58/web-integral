@extends('web.layout-auth')
@section('title', 'Register Integral Education')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    <h3 class="title">Register</h3>
    <form class="max-width-auto" action="/register" method="POST">
        @csrf
        <div class="form-group @if(old('email')) focused @endif">
            <input name="email" type="text" value="{{ old('email') }}"/>
            <label>Email *</label>
            <span class="focus-border"></span>
            @error('email')
                <span class="message-info">{{ $message }}</span>  
            @enderror
        </div>

        <div class="form-group @if(old('username')) focused @endif">
           
            <input name="username" type="text" value="{{ old('username') }}"/>
            <label>Username *</label>
            <span class="focus-border"></span>
            @error('username')
                <span class="message-info">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input name="password" type="password" id="password"/>
            <label>Password *</label>
            <span class="focus-border"></span>
            <i class="feather-eye toggle-password" id="togglePassword"></i>

            @error('password')
                <span class="message-info">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input name="password_confirmation" type="password" id="password_confirmation"/>
            <label>Password Confirmation *</label>
            <span class="focus-border"></span>
            <i class="feather-eye toggle-password" id="toggleConfirmationPassword"></i>
            @error('password_confirmation')
                <span class="message-info">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-submit-group">
            <button type="submit" class="rbt-btn btn-gradient btn-md hover-icon-reverse w-100 radius-6">
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