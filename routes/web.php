<?php

use App\Http\Controllers\App;
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
require __DIR__.'/auth.php';

Route::get('/', [App\SessionController::class, 'login']);
Route::get('/latest', [App\SessionController::class, 'latest'])->middleware(['auth'])->name('latest');
Route::get('/surveys', [App\SessionController::class, 'surveys'])->middleware(['auth'])->name('surveys');
Route::get('/dashboard', [App\SessionController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/stats/{survey}', [App\SessionController::class, 'stats'])->middleware(['auth'])->name('stats');

Route::post('/surveys/delete/{survey}', [App\SurveyController::class, 'delete'])->middleware(['auth']);
Route::post('/surveys/create', [App\SurveyController::class, 'create'])->middleware(['auth']);
Route::get('/surveys/{survey}', [App\SurveyController::class, 'index'])->middleware(['auth']);
Route::get('/survey/{survey:name}', [App\SurveyController::class, 'show']);//->middleware('guest');

Route::post('/surveys/{survey}', [App\QuestionController::class, 'store'])->middleware(['auth']);

Route::post('/survey/{survey:name}', [App\AnswerController::class, 'store']);//->middleware('guest');

Route::get('{uri}', [App\SessionController::class, 'check'])->middleware('guest');

