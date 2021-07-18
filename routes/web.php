<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AnalyzeController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('/questions', QuestionController::class)
        ->names([
            'index' => 'question.index',
            'create' => 'question.create',
            'store' => 'question.store',
            'show' => 'question.show',
            'edit' => 'question.edit',
            'update' => 'question.update'
        ]);
    Route::resource('/answers', AnswerController::class)
        ->names([
            'index' => 'answer.index',
            'create' => 'answer.create',
            'store' => 'answer.store',
            'show' => 'answer.show',
            'update' => 'answer.update',
            'destroy' => 'answer.destroy'
        ]);
    Route::resource('/analyze', AnalyzeController::class)
    ->names([
        'index' => 'analyze.index',
        'create' => 'analyze.create',
        // 'store' => 'analysis.store',
        'show' => 'analyze.show',
        // 'update' => 'analysis.update',
        // 'destroy' => 'analysis.destroy'
    ]);

    // original
    Route::post('/analyze/report', [App\Http\Controllers\AnalyzeController::class, 'report'])
        ->name('analyze.report');
    Route::post('/analyze/result', [App\Http\Controllers\AnalyzeController::class, 'result'])
        ->name('analyze.result');

    // test
    Route::post('/question/getJSON/{type}', [App\Http\Controllers\QuestionController::class, 'getJSON'])
        ->name('question.getJSON');
});