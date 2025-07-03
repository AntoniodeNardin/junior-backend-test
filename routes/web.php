<?php

use App\Http\Controllers\CreateContactController;
use App\Http\Controllers\ListContactsController;
use App\Http\Controllers\UpdateContactController;
use App\Http\Controllers\DeleteContactController;

use Illuminate\Support\Facades\Route;

Route::post('/contacts', CreateContactController::class);
Route::get('/contacts', ListContactsController::class);
Route::put('/contacts/{contact}', UpdateContactController::class);
Route::delete('/contacts/{contact}', DeleteContactController::class);



