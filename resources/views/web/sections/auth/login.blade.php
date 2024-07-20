@extends('web.layout-auth')
@section('title', 'Login Integral Education')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    {{-- @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <span>{{ session('status') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif --}}
    <h3 class="title">Login</h3>
    <form action="/login" method="POST">
        @csrf
        <div class="form-group @if(old('email')) focused @endif">
            <input name="email" type="text" value="{{old('email')}}"/>
            <label>Email *</label>
            <span class="focus-border"></span>
            @error('email')
                <span class="message-info">{{ $message }}</span>  
            @enderror
        </div>
        <div class="form-group">
            <input name="password" type="password" value="{{ old('password') }}" id="password"/>
            <label>Password *</label>
            <span class="focus-border"></span>
            <i class="feather-eye toggle-password" id="togglePassword"></i>
            @error('password')
                <span class="message-info">{{ $message }}</span>
            @enderror
        </div>
        <div class="row mb--30">
            <div class="col-12 text-end">
                <div class="rbt-lost-password">
                    <a class="rbt-btn-link forget-password" href="{{route('password.request')}}">Lupa password?</a>
                </div>
            </div>
        </div>

        <div class="form-submit-group">
            <button type="submit" class="rbt-btn btn-gradient btn-md icon-hover w-100 radius-6">
                <span class="icon-reverse-wrapper">
                    <span class="btn-text">Log In</span>
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
@push('scripts')
<script>
    //tampilkan sweetalert2 jika berhasil mengirim email reset password dan redirect ke halaman login
    @if (session('status'))
        Swal.fire({
            icon: 'info',
            // title: 'Berhasil',
            text: '{{ session('status') }}',
            showConfirmButton: true,
            // timer: 3000
        });
    @endif
</script>
@endpush