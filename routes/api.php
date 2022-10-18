<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//for live update
use App\Http\Controllers\LiveReport\ManageController;

Route::post('livestore', [ManageController::class, 'livestore']);
Route::post('getusers', [ManageController::class, 'getusers']);
