<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [IssueController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/issues', [IssueController::class, 'all'])->name('issues.all');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');
    Route::get('/issues/{issue}', [IssueController::class, 'show'])->name('issues.show');
    Route::get('/issues/{issue}/edit', [IssueController::class, 'edit'])->name('issues.edit');
    Route::put('/issues/{issue}', [IssueController::class, 'update'])->name('issues.update');
    Route::post('/issues/{issue}/upvote', [IssueController::class, 'upvote'])->name('issues.upvote');
    Route::post('/issues/{issue}/comments', [IssueController::class, 'storeComment'])->name('issues.comments.store');
    Route::get('/map', [IssueController::class, 'map'])->name('issues.map');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/moderation', [AdminController::class, 'moderation'])->name('admin.moderation');
    Route::get('/admin/issues/{issue}/edit', [AdminController::class, 'editIssue'])->name('admin.issues.edit');
    Route::put('/admin/issues/{issue}', [AdminController::class, 'updateIssue'])->name('admin.issues.update');
    Route::delete('/admin/issues/{issue}', [AdminController::class, 'deleteIssue'])->name('admin.issues.delete');
});

require __DIR__.'/auth.php';
