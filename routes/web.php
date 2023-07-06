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

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('questions', Question\QuestionController::class)->name('question.index');
    // Route::get('question/{question}/edit', Question\EditController::class)->name('question.edit');

    // Route::post('question/store', Question\StoreController::class)->name('question.store');
    Route::post('question/{question}/archive', Question\ArchiveController::class)->name('question.archive');
    Route::post('question/{question}/like', Question\LikeController::class)->name('question.like');
    Route::post('question/{question}/unlike', Question\UnlikeController::class)->name('question.unlike');

    // Route::put('question/{question}/update', Question\PublishController::class)->name('question.update');
    Route::put('question/{question}/publish', Question\PublishController::class)->name('question.publish');

    // Route::delete('question/{question}', Question\DestroyController::class)->name('question.destroy');

    Route::resource('question', QuestionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
