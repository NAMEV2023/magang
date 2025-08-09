<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Home');
});

Route::get('/About', function () {
    return view('About');
});

Route::get('/Menu', function () {
    return view('Menu');
});

Route::get('/Gallery', function () {
    return view('Gallery');
});

Route::get('/Lokasi', function () {
    return view('Lokasi');
});

?>