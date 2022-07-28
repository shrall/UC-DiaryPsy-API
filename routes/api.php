<?php

use App\Http\Controllers\Api\Admin\CharacterController as AdminCharacterController;
use App\Http\Controllers\Api\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Api\Admin\InstituteController as AdminInstituteController;
use App\Http\Controllers\Api\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Api\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Api\Admin\QuestionTypeController as AdminQuestionTypeController;
use App\Http\Controllers\Api\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Api\Admin\ReligionController as AdminReligionController;
use App\Http\Controllers\Api\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Api\Admin\TribeController as AdminTribeController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Admin\UserModuleController as AdminUserModuleController;
use App\Http\Controllers\Api\Admin\UserQuestionController as AdminUserQuestionController;
use App\Http\Controllers\Api\Admin\UserQuizController as AdminUserQuizController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\User\CharacterController as UserCharacterController;
use App\Http\Controllers\Api\User\EducationController as UserEducationController;
use App\Http\Controllers\Api\User\InstituteController as UserInstituteController;
use App\Http\Controllers\Api\User\ModuleController as ApiUserModuleController;
use App\Http\Controllers\Api\User\QuestionController as ApiUserQuestionController;
use App\Http\Controllers\Api\User\QuestionTypeController as UserQuestionTypeController;
use App\Http\Controllers\Api\User\QuizController as ApiUserQuizController;
use App\Http\Controllers\Api\User\ReligionController as UserReligionController;
use App\Http\Controllers\Api\User\RoleController as UserRoleController;
use App\Http\Controllers\Api\User\TribeController as UserTribeController;
use App\Http\Controllers\Api\User\UserController as UserUserController;
use App\Http\Controllers\Api\User\UserModuleController as UserUserModuleController;
use App\Http\Controllers\Api\User\UserQuestionController as UserUserQuestionController;
use App\Http\Controllers\Api\User\UserQuizController as UserUserQuizController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EducationController;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgot-password', [LoginController::class, 'forgot_password']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/email/verify', [RegisterController::class, 'resend_email']);

Route::group(['middleware' => 'auth:api', 'as' => 'api.user.'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});

// Route::apiResource('character', CharacterController::class);
// Route::apiResource('institute', InstituteController::class);
// Route::apiResource('module', ModuleController::class);
// Route::apiResource('question', QuestionController::class);
// Route::apiResource('questiontype', QuestionTypeController::class);
// Route::apiResource('quiz', QuizController::class);
// Route::apiResource('religion', ReligionController::class);
// Route::apiResource('role', RoleController::class);
// Route::apiResource('tribe', TribeController::class);
// Route::apiResource('user', UserController::class);
// Route::apiResource('usermodule', UserModuleController::class);
// Route::apiResource('userquestion', UserQuestionController::class);
// Route::apiResource('userquiz', UserQuizController::class);
// Route::apiResource('education', EducationController::class);

Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function () {
    Route::apiResource('character', AdminCharacterController::class);
    Route::apiResource('institute', AdminInstituteController::class);
    Route::apiResource('education', AdminEducationController::class);
    Route::apiResource('module', AdminModuleController::class);
    Route::apiResource('question', AdminQuestionController::class);
    Route::apiResource('questiontype', AdminQuestionTypeController::class);
    Route::apiResource('quiz', AdminQuizController::class);
    Route::apiResource('religion', AdminReligionController::class);
    Route::apiResource('role', AdminRoleController::class);
    Route::apiResource('tribe', AdminTribeController::class);
    Route::apiResource('user', AdminUserController::class);
    Route::post('/user/{user}/module/add', [AdminUserController::class, 'module_add']);
    Route::post('/user/{user}/module/delete', [AdminUserController::class, 'module_delete']);
    Route::apiResource('usermodule', AdminUserModuleController::class);
    Route::apiResource('userquestion', AdminUserQuestionController::class);
    Route::apiResource('userquiz', AdminUserQuizController::class);
    Route::post('/module/reorder', [AdminModuleController::class, 'reorder']);
    Route::post('/character/reorder', [AdminCharacterController::class, 'reorder']);
    Route::post('/quiz/reorder', [AdminQuizController::class, 'reorder']);
    Route::post('/question/reorder', [AdminQuestionController::class, 'reorder']);
});

Route::group(['prefix' => 'location'], function () {
    Route::get('/province', [LocationController::class, 'province']);
    Route::get('/city', [LocationController::class, 'city']);
    Route::get('/district', [LocationController::class, 'district']);
    Route::get('/village', [LocationController::class, 'village']);
});

Route::group(['prefix' => 'user'], function () {
    Route::apiResource('education', UserEducationController::class);
    Route::apiResource('institute', UserInstituteController::class);
    Route::apiResource('religion', UserReligionController::class);
    Route::apiResource('tribe', UserTribeController::class);
});
Route::group(['middleware' => 'auth:api', 'prefix' => 'user'], function () {
    Route::apiResource('character', UserCharacterController::class);
    Route::apiResource('module', ApiUserModuleController::class);
    Route::apiResource('question', ApiUserQuestionController::class);
    Route::apiResource('questiontype', UserQuestionTypeController::class);
    Route::apiResource('quiz', ApiUserQuizController::class);
    Route::get('/quiz/{quiz}/results', [ApiUserQuizController::class, 'results']);
    Route::apiResource('role', UserRoleController::class);
    Route::apiResource('usermodule', UserUserModuleController::class);
    Route::apiResource('userquestion', UserUserQuestionController::class);
    Route::apiResource('userquiz', UserUserQuizController::class);
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('user', UserUserController::class);
});
