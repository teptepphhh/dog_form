<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages/main');
});

// Fetch the list of dog breeds from the DogController
Route::get('/breeds', [App\Http\Controllers\DogController::class, 'list_breeds'])->name('list_breeds');

// Fetch a random image for a selected breed from the DogController
Route::post('/fetch_dog', [App\Http\Controllers\DogController::class, 'produce_image'])->name('produce_image');