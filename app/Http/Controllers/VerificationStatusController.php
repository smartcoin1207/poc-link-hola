<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationStatusController extends Controller
{
    public function index (Request $request)
    {
        return view('verification-status.index');
    }
}
