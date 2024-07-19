@extends('web.layout-auth')
@section('title', 'Reset Password')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    <h3 class="title">Reset Password</h3>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ $request->email }}">
        <div class="form-group">
            {{-- <input name="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="password"> --}}
            <input id="password" name="password" type="password"/>
            <label>Password *</label>
            <span class="focus-border"></span>
            @error('password')
                <span class="message-info">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            {{-- <input name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="confirm password"> --}}
            <input id="password-confirm" name="password_confirmation" type="password"/>
            <label>Password Confirmation *</label>
            <span class="focus-border"></span>
            @error('password_confirmation')
                <span class="message-info">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-submit-group">
            <button type="submit" class="rbt-btn btn-gradient btn-md hover-icon-reverse w-100 radius-6">
                <span class="icon-reverse-wrapper">
                    <span class="btn-text">Reset Password</span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                </span>
            </button>
        </div>
    </form>
</div>
@endsection