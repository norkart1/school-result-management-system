<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminAuthController;

// Redirect the home route to /new-form
Route::get('/', function () {
    return view('new-form');
})->name('students.index');

/// Route to generate PDF based on roll number
Route::get('/students/download/{roll_number}', [StudentController::class, 'download'])->name('students.download');


// Both result in Single Page

// Route to display the results search page
Route::get('/results', function () {
    return view('dars_results');
})->name('dars.results');

// NEW FORM

// Route to handle the form for both searches
Route::get('/new-form', function () {
    return view('new-form');
})->name('new.form');

// SCHOOL WISE RESULT

// Route to display the form to input the school code
Route::get('/search-school', [StudentController::class, 'showSchoolForm'])->name('school.search.form');

// Route to display the results based on the school code
Route::post('/school-results', [StudentController::class, 'getSchoolResults'])->name('school.results');

// SCHOOL WISE RESULT END

// STUDENT WISE RESULT

// Search results route - Handles the search functionality
Route::post('/search', [StudentController::class, 'search'])->name('students.search');

// TEST ROUTE - Secured for development only
Route::get('/test-csv', function () {
    // Only allow in local development environment
    if (!app()->environment('local')) {
        abort(404);
    }
    
    $csvPath = storage_path('app/results.csv');

    if (!file_exists($csvPath)) {
        return 'CSV file not found.';
    }

    $content = file_get_contents($csvPath);
    return nl2br($content); // Outputs the file content
})->middleware(['auth', 'admin']);

// DATABASE MANAGEMENT - Adminer (PostgreSQL phpMyAdmin alternative)
Route::any('/adminer', '\Onecentlin\Adminer\AdminerController@index')->middleware(['web', 'admin'])->name('adminer');

// ADMIN ROUTES

// Admin login routes
Route::middleware(['web', 'guest'])->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login')->middleware('throttle:5,1');
});

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout')->middleware(['web', 'auth']);

// Protected admin routes
Route::middleware(['web', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    
    // Student Management - Full CRUD
    Route::get('/admin/students', [\App\Http\Controllers\Admin\StudentController::class, 'index'])->name('admin.students.index');
    Route::get('/admin/students/create', [\App\Http\Controllers\Admin\StudentController::class, 'create'])->name('admin.students.create');
    Route::post('/admin/students', [\App\Http\Controllers\Admin\StudentController::class, 'store'])->name('admin.students.store');
    Route::get('/admin/students/{student}', [\App\Http\Controllers\Admin\StudentController::class, 'show'])->name('admin.students.show');
    Route::get('/admin/students/{student}/edit', [\App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('admin.students.edit');
    Route::put('/admin/students/{student}', [\App\Http\Controllers\Admin\StudentController::class, 'update'])->name('admin.students.update');
    Route::delete('/admin/students/{student}', [\App\Http\Controllers\Admin\StudentController::class, 'destroy'])->name('admin.students.destroy');
    
    // School Management
    Route::get('/admin/schools', [\App\Http\Controllers\Admin\StudentController::class, 'listBySchool'])->name('admin.schools');
    Route::get('/admin/schools/{schoolCode}', [\App\Http\Controllers\Admin\StudentController::class, 'showSchool'])->name('admin.schools.show');
});

// Redirect /admin to login or dashboard based on auth status
Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect('/admin/dashboard');
    }
    return redirect('/admin/login');
})->middleware('web');
