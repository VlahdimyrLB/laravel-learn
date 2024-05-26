<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    // We can also return strings or arrays
    // return "About Page"; 
    // return ["food" => "var"];
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
