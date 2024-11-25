<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

Route::get('/current-user', [UserController::class, 'user'])->middleware('auth:sanctum');