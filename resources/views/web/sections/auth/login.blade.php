@extends('web.layout-auth')
@section('title', 'Login Integral Education')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    @if (session('status'))
    <div class="alert alert-warning" role="alert">
        <span></span>{{ session('status') }}
    </div>
    @endif
    <h3 class="title">Login</h3>
    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <input name="email" type="text" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="email"/>
            @error('email')
                <span class="message-info">{{ $message }}</span>  
            @enderror
            {{-- <label>Email *</label>
            <span class="focus-border"></span> --}}
        </div>
        <div class="form-group">
            <input name="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="password">
            @error('password')
                <span class="message-info">{{ $message }}</span>
            @enderror
            {{-- <label>Password *</label>
            <span class="focus-border"></span> --}}
        </div>

        <div class="row mb--30">
            <div class="col-lg-6">
                <div class="rbt-checkbox">
                    <input type="checkbox" id="rememberme" name="rememberme">
                    <label for="rememberme">Remember me</label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="rbt-lost-password text-end">
                    <a class="rbt-btn-link" href="#">Lupa password?</a>
                </div>
            </div>
        </div>

        <div class="form-submit-group">
            <button type="submit" class="rbt-btn btn-md bg-primary hover-icon-reverse w-100">
                <span class="icon-reverse-wrapper">
                    <span class="btn-text">Log In</span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                </span>
            </button>
        </div>
    </form>
    <div class="pt-5 text-center">
        <p>Belum memiliki akun? <a href="/register">Daftar</a></p>
    </div>
</div>
@endsection