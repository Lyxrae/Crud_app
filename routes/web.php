<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

//Student routes
Route::get('/students', [StudentController::class, 'index']);
Route::post('/addstudent', [StudentController::class, 'store'])->name('addstudent');
Route::post('/editstudent/{id}', [StudentController::class, 'update'])->name('editstudent');
Route::get('/deletestudent/{id}', [StudentController::class, 'destroy'])->name('deletestudent');

//Course routes
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/addcourse', [CourseController::class, 'store'])->name('addcourse');
Route::post('/editscourse/{id}', [CourseController::class, 'update'])->name('editcourse');
Route::get('/deletecourse/{id}', [CourseController::class, 'destroy'])->name('deletecourse');