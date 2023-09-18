<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\Staff\HomeController;
use App\Http\Controllers\Staff\EmailController;
use App\Http\Controllers\Staff\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Staff\BookController;
use App\Http\Controllers\Staff\LanguageController;
use App\Http\Controllers\Staff\QuestionController;
use App\Http\Controllers\Staff\QuestionSetController;
use App\Http\Controllers\Staff\SetController;
use App\Http\Controllers\Staff\SubjectController;

//Staff Routes
Route::namespace('Staff')->prefix('staff')->name('staff.')->group(function () {
    Route::namespace('Auth')->middleware('guest:staff')->group(function () {
        //Login Route
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    });
    Route::middleware('staff')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});
Route::middleware('staff')->prefix('staff')->name('staff.')->group(function () {
    // Email Crud
    Route::get('email/{id}/delete', [EmailController::class, 'destroy']);
    Route::resource('email', EmailController::class);
    //Profile
    Route::get('/profile', [HomeController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [HomeController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [HomeController::class, 'update'])->name('profile.update');
    //Suport Ticekts View And Reply
    Route::get('support', [SupportController::class, 'staffIndex'])->name('support.index');
    Route::get('support/{id}', [SupportController::class, 'staffAdmin'])->name('support.show');
    Route::get('support/{id}/reply', [SupportController::class, 'staffReply'])->name('support.reply');
    Route::put('support/{id}', [SupportController::class, 'staffReplyUpdate'])->name('support.replyUpdate');
    // Language Crud
    Route::get('language/{id}/delete', [LanguageController::class, 'destroy']);
    Route::resource('language', LanguageController::class);
    // Subject Crud
    Route::get('subject/{id}/delete', [SubjectController::class, 'destroy']);
    Route::resource('subject', SubjectController::class);
    // Book Crud
    Route::get('book/{id}/delete', [BookController::class, 'destroy']);
    Route::resource('book', BookController::class);
    // Question Crud
    Route::get('question/{id}/delete', [QuestionController::class, 'destroy']);
    Route::resource('question', QuestionController::class);
    // Question Set Crud
    Route::get('qset/{id}/delete', [SetController::class, 'destroy']);
    Route::resource('qset', SetController::class);
    // Question Set - Question and Set Relation Crud
    Route::get('quesset/{id}/delete', [QuestionSetController::class, 'destroy']);
    Route::get('quesset/', [QuestionSetController::class, 'index'])->name('quesset.index');
    Route::get('quesset/{id}/add/', [QuestionSetController::class, 'create'])->name('quesset.create');
    Route::get('quesset/{id}/', [QuestionSetController::class, 'show'])->name('quesset.show');
    Route::post('quesset/add', [QuestionSetController::class, 'store'])->name('quesset.store');
    Route::put('quesset/add', [QuestionSetController::class, 'update'])->name('quesset.update');
    Route::get('quesset/add/{id}', [QuestionSetController::class, 'edit'])->name('quesset.edit');
});
