<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TryoutDetailController extends Controller
{
    public function index()
    {
        return view('web.sections.landing-page.tryout-detail');
    }
}
