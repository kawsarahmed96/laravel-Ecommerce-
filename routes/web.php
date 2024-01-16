<?php

use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);
require __DIR__ . '/frontend.php';
require __DIR__ . '/backend.php';