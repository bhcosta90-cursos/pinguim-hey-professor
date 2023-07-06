<?php

use App\Http\Controllers\Question;
use App\Http\Controllers\{DashboardController, ProfileController, QuestionController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    if (app()->isLocal()) {
        auth()->loginUsingId($request->user ?: 1);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::patch('question/{question}/archive', [QuestionController::class, 'archive'])->name('question.archive');
    Route::patch('question/{question}/restore', [QuestionController::class, 'restore'])->name('question.restore');
    Route::post('question/{question}/like', Question\LikeController::class)->name('question.like');
    Route::post('question/{question}/unlike', Question\UnlikeController::class)->name('question.unlike');
    Route::put('question/{question}/publish', Question\PublishController::class)->name('question.publish');
    Route::resource('question', QuestionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
