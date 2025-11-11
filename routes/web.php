<?php

use Illuminate\Support\Facades\Route;


//----- SITE -----

Route::get('/', function () {
    return view('page.welcome');
})->name('home');

Route::get('/product', function () {
    return view('page.product');
})->name('product');

Route::get('/cart', function () {
    return view('page.cart');
})->name('cart');

Route::get('/contact', function () {
    return view('page.contact');
})->name('contact');

Route::get('/about', function () {
    return view('page.about');
})->name('about');

Route::get('/checkout', function () {
    return view('page.checkout');
})->name('checkout');


//----- ADMIN -----

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/users', function () {
    return view('admin.users');
})->name('users');