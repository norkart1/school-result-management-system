<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

// TEST ROUTE

// Test route - To test if the CSV file is accessible and readable
Route::get('/test-csv', function () {
    $csvPath = storage_path('app/results.csv');

    if (!file_exists($csvPath)) {
        return 'CSV file not found.';
    }

    $content = file_get_contents($csvPath);
    return nl2br($content); // Outputs the file content
});
