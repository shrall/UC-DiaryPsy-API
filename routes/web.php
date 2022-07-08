<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TribeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserModuleController;
use App\Http\Controllers\UserQuestionController;
use App\Http\Controllers\UserQuizController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class);
Route::resource('character', CharacterController::class);
Route::resource('institute', InstituteController::class);
Route::resource('module', ModuleController::class);
Route::resource('question', QuestionController::class);
Route::resource('questiontype', QuestionTypeController::class);
Route::resource('quiz', QuizController::class);
Route::resource('religion', ReligionController::class);
Route::resource('role', RoleController::class);
Route::resource('tribe', TribeController::class);
Route::resource('usermodule', UserModuleController::class);
Route::resource('userquestion', UserQuestionController::class);
Route::resource('userquiz', UserQuizController::class);
