<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SpaController extends Controller
{
    public function index(): View
    {
        return view('spa');
    }

    public function landingPage(): View
    {
        return view('landing');
    }
}
