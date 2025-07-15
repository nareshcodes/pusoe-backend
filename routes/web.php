<?php

use App\Http\Controllers\admin\BooksController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\NotesController;
use App\Http\Controllers\admin\QuestionsController;
use App\Http\Controllers\admin\SemesterController;
use App\Http\Controllers\admin\SyllabusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource("/company",CompanyController::class);
    Route::resource("/semester",SemesterController::class);
    Route::resource("/category",CategoryController::class);
    Route::resource("/syllabus",SyllabusController::class);
    Route::resource("/questions",QuestionsController::class);
    Route::resource("/notes",NotesController::class);
    Route::resource("/books",BooksController::class);

});


require __DIR__ . '/auth.php';



