<?php

namespace App\Http\Controllers;

class BackendController extends Controller
{
    //
    public function index()
    {
        return view('backend.index');
    }

    public function ResetPass()
    {
        return view('Auth.passwords.email');
    }
}
