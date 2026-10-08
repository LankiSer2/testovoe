<?php

use App\Modules\User\Controllers\CreateController;
use App\Modules\User\Controllers\DeleteController;
use App\Modules\User\Controllers\ReadController;
use App\Modules\User\Controllers\UpdateController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', CreateController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', ReadController::class);
    Route::put('/profile', UpdateController::class);
    Route::delete('/profile', DeleteController::class);
});
