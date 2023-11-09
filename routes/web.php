<?php

use App\Http\Controllers\{DashboardController, ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store'); // criar a rota depois que fizer o make:controller, e na ação vai ser um array, porque o primeiro item vai ser o controlador e o segundo um método que tem lá dentro
Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');
Route::post('/question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');
Route::put('/question/publish/{question}', Question\PublishController::class)->name('question.publish');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
