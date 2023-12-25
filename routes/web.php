<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;


Route::get('/', [FileUploadController::class, 'index']);
Route::post('/uploadFile', [FileUploadController::class, 'store'])->name('uploadFile');
