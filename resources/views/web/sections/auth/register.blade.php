@extends('web.layout-auth')
@section('title', 'Register Integral Education')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    <h3 class="title">Register</h3>
    <form class="max-width-auto">
        <div class="form-group">
            <input name="register-email" type="text" />
            <label>Email *</label>
            <span class="focus-border"></span>
        </div>

        <div class="form-group">
            <input name="register_user" type="text">
            <label>Username</label>
            <span class="focus-border"></span>
        </div>

        <div class="form-group">
            <input name="register_password" type="password">
            <label>Password</label>
            <span class="focus-border"></span>
        </div>

        <div class="form-group">
            <input name="register_conpassword" type="password">
            <label>Confirm Password</label>
            <span class="focus-border"></span>
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