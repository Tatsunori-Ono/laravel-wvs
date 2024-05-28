<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/showcase', function () {
    return view('showcase');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/recyclable-boxes', function () {
    return view('recyclable-boxes');
});

Route::get('/', function () {
    return redirect('/about');
});