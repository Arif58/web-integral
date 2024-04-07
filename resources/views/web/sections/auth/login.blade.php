@extends('web.layout-auth')
@section('title', 'Login Integral Education')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    <h3 class="title">Login</h3>
    <form>
        <div class="form-group">
            <input name="con_name" type="text" />
            <label>Email *</label>
            <span class="focus-border"></span>
        </div>
        <div class="form-group">
            <input name="con_email" type="email">
            <label>Password *</label>
            <span class="focus-border"></span>
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