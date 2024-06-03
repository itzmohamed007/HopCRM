<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganisationController;
use Illuminate\Support\Facades\Route;


Route::get('v1/contacts', [ContactController::class, 'index']);
Route::get('v1/contacts/search/{target}', [ContactController::class, 'search']);
Route::get('v1/contacts/{id}', [ContactController::class, 'show']);
Route::post('v1/contacts', [ContactController::class, 'store']);
Route::put('v1/contacts', [ContactController::class, 'update']);
Route::delete('v1/contacts', [ContactController::class, 'destroy']);

Route::post('v1/contacts/duplicate', [ContactController::class, 'isDuplicate']);
Route::post('v1/organisations/duplicate', [OrganisationController::class, 'isDuplicate']);

Route::fallback(function () {
    return response()->json([
        'message' => 'Route Not Found'
    ], 404);
});
