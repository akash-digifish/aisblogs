<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PodcastController;



Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactMessageController::class, 'index']);   
    Route::get('/{id}', [ContactMessageController::class, 'show']); 
    Route::post('/', [ContactMessageController::class, 'store']);  
    Route::post('connectemailstore', [ContactMessageController::class, 'connectemailstore']);  
});



Route::apiResource('podcasts', PodcastController::class);
Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogApiController::class, 'index']);  
    Route::get('/{slug}', [BlogApiController::class, 'show']); 
});



// Store a message
Route::post('/contact', [ContactMessageController::class, 'store']);

// Get all messages
Route::get('/contact', [ContactMessageController::class, 'index']);

// Get single message by ID
Route::get('/contact/{id}', [ContactMessageController::class, 'show']);


