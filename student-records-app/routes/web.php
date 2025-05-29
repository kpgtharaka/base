<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('students', StudentController::class);
    Route::resource('school-classes', SchoolClassController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('marks', MarkController::class)->only(['index', 'create', 'store']);

    // Reports
    Route::get('reports/student-performance', [ReportController::class, 'studentPerformanceForm'])->name('reports.student.form');
    Route::get('reports/student-performance/{student}', [ReportController::class, 'showStudentPerformance'])->name('reports.student.show');

    Route::get('reports/class-performance', [ReportController::class, 'classPerformanceForm'])->name('reports.class.form');
    Route::get('reports/class-performance/results', [ReportController::class, 'showClassPerformance'])->name('reports.class.show'); // Using query params

    // JSON API endpoint for dynamic loading
    Route::get('/school-classes/{schoolClass}/students-json', [SchoolClassController::class, 'getStudentsJson'])->name('school-classes.students.json');
});

require __DIR__.'/auth.php';
