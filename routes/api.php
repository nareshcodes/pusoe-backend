<?php

use App\Http\Controllers\api\AdminController;
use App\Models\semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

    Route::get("/company",[AdminController::class, "company"]);
    Route::get("/semester",[AdminController::class, "semester"]);
    Route::get("/syllabus",[AdminController::class,"syllabus"]);
    Route::get("/questions",[AdminController::class, "questions"]);
    Route::get("/notes/{semester}",[AdminController::class, "notes"]);
    Route::get("/books",[AdminController::class, "books"]);
