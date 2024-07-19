@extends('web.layout-auth')
@section('title', 'Forgot Password')
@section('content')
<div class="rbt-contact-form contact-form-style-1 max-width-auto">
    <h3 class="title">Lupa Password</h3>
    <form id="forgot-password-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input name="email" type="text" value="{{ old('email') }}"/>
            <label>Email *</label>
            <span class="focus-border"></span>
            @error('email')
                <span class="message-info">{{ $message }}</span>  
            @enderror
        </div>

        <div class="form-submit-group">
            <button type="submit" class="rbt-btn btn-gradient btn-md hover-icon-reverse w-100 radius-6">
                <span class="icon-reverse-wrapper">
                    <span class="btn-text">Kirim</span>
                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                </span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    //tampilkan sweetalert2 jika berhasil mengirim email reset password dan redirect ke halaman login
    @if (session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('
            status ') }}',
            showConfirmButton: false,
            timer: 2000
        }).then(function() {
            window.location.href = '/login';
        });
    @endif
</script>
@endpush
