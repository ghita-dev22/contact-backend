<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


    Route::get('contacts', [ContactController::class, 'contacts']);
    Route::post('addContact', [ContactController::class, 'addContact']);
    Route::delete('deleteContact/{id}', [ContactController::class, 'deleteContact']);
    Route::get('contact/{id}', [ContactController::class, 'contactById']);
    Route::patch('updateContact/{id}', [ContactController::class, 'updateContact']);
