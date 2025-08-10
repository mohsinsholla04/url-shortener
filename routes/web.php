<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

// Show the form
Route::get('/', [UrlController::class, 'index']);

// Process URL shortening
Route::post('/shorten', [UrlController::class, 'shorten']);

// Redirect short URLs to original URLs
Route::get('/{shortCode}', [UrlController::class, 'redirect']);
