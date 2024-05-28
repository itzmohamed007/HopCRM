<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganisationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactController::class, 'index']);
