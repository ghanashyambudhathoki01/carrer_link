<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/internship', function () {
    return view('pages.internship');
})->name('internship');

Route::get('/jobs', function () {
    return view('pages.jobs');
})->name('jobs');

Route::get('/eventify', function () {
    return view('pages.eventify');
})->name('eventify');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::get('/subscriptions', function () {
    return view('pages.subscriptions');
})->name('subscriptions');

Route::get('/help-center', function () {
    return view('pages.help-center');
})->name('help-center');

Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
})->name('privacy-policy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
