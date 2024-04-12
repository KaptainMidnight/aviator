<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::post('/authenticate', AuthenticateController::class)->name('authenticate');
