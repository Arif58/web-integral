<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return redirect()->intended('/login')->with('status', 'Silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan ke email Anda. Tunggu 2-3 menit hingga email masuk ke kotak masuk Anda atau cek folder spam jika tidak ada di kotak masuk.');

    }
}
