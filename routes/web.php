<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

//Student routes
Route::get('/students', [StudentController::class, 'index']);
Route::post('/addstudent', [StudentController::class, 'store'])->name('addstudent');
Route::post('/editstudent/{id}', [StudentController::class, 'update'])->name('editstudent');
Route::get('/deletestudent/{id}', [StudentController::class, 'destroy'])->name('deletestudent');