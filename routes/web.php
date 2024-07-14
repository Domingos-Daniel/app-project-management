<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Mail::to('domingoscahandadaniel@gmail.com')
    // ->send(new \App\Mail\HelloMail());
    return view('welcome');
});


