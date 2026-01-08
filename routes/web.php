<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\InterviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Only Routes (Can edit) - এগুলো সবার আগে
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create');
    Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store');
    Route::get('/candidates/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidates.edit');
    Route::put('/candidates/{candidate}', [CandidateController::class, 'update'])->name('candidates.update');
    Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy'])->name('candidates.destroy');
    
    // Interview Scheduling
    Route::get('/interviews/schedule', [InterviewController::class, 'scheduleForm'])->name('interviews.schedule.form');
    Route::post('/interviews/schedule', [InterviewController::class, 'schedule'])->name('interviews.schedule');
    Route::post('/interviews/schedule-range', [InterviewController::class, 'scheduleRange'])->name('interviews.schedule.range');
    Route::post('/interviews/{interview}/mark-complete', [InterviewController::class, 'markComplete'])->name('interviews.mark.complete');
    Route::post('/interviews/{interview}/mark-result', [InterviewController::class, 'markResult'])->name('interviews.mark.result');
    
    // Second Interview
    Route::get('/interviews/schedule-second', [InterviewController::class, 'scheduleSecond'])->name('interviews.schedule.second');
});

// Admin & Staff Routes (Can view)
Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
    Route::get('/candidates/hired', [CandidateController::class, 'hired'])->name('candidates.hired');
    Route::get('/candidates/rejected', [CandidateController::class, 'rejected'])->name('candidates.rejected');
    
    // Upload Excel
    Route::get('/candidates/upload/form', [CandidateController::class, 'uploadForm'])->name('candidates.upload.form');
    Route::post('/candidates/import', [CandidateController::class, 'import'])->name('candidates.import');
    
    // Interviews View
    Route::get('/interviews/upcoming', [InterviewController::class, 'upcoming'])->name('interviews.upcoming');
    Route::get('/interviews/completed', [InterviewController::class, 'completed'])->name('interviews.completed');
    Route::get('/interviews/download-phones', [InterviewController::class, 'downloadPhones'])->name('interviews.download.phones');
    
    // Show route - একদম শেষে
    Route::get('/candidates/{candidate}', [CandidateController::class, 'show'])->name('candidates.show');
});

require __DIR__.'/auth.php';