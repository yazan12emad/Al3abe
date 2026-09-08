<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/al3abe-test', function () {
    return view('al3abe.test');
})->name('al3abe.test');
