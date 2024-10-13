<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf; // Import the DomPDF facade
use ArPHP\I18N\Arabic;


class StudentController extends Controller
{
    // Show the form to input the roll number
    public function index()
    {
        return view('students.index'); // A simple form to enter the roll number
    }

    // Handle the form submission and search for student by roll number
    public function search(Request $request)
    {
        // Validate the input (ensure roll_number is provided)
        $validator = Validator::make($request->all(), [
            'roll_number' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Search the student by roll number including those with 0 marks
        $student = Student::where('roll_number', $request->roll_number)->first();

        if (!$student) {
            // If student is not found, return a message
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Calculate total marks, treating 'غ' (absent) as 0
        $student->total_marks = collect($student->subjects)->sum(function($subject) {
            return $subject['marks'] === 'غ' ? 0 : $subject['marks'];
        });

        // If student is found, return a view with the student data
        return view('students.result', ['student' => $student]);
    }

    // Show the form to input the school code
    public function showSchoolForm()
    {
        return view('students.school'); // A form for entering the school code
    }

    // Handle the form submission and search for students by school code
    public function getSchoolResults(Request $request)
    {
        // Validate the input (ensure school_code is provided)
        $request->validate([
            'school_code' => 'required|string',
        ]);

        // Search for all students by the school code
        $students = Student::where('school_code', $request->school_code)->get();

        // Calculate total marks for each student, treating 'غ' (absent) as 0
        foreach ($students as $student) {
            $student->total_marks = collect($student->subjects)->sum(function($subject) {
                return $subject['marks'] === 'غ' ? 0 : $subject['marks'];
            });
        }

        // If no students found, return an error message
        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No school found in this school code.');
        }

        // Grade counts
    $gradeCounts = [
    'Top Plus' => $students->where('grade', 'Top Plus')->count(), // Add Top Plus grade count
    'Distinction' => $students->where('grade', 'Distinction')->count(),
    'First Class' => $students->where('grade', 'First Class')->count(),
    'Second Class' => $students->where('grade', 'Second Class')->count(),
    'Third Class' => $students->where('grade', 'Third Class')->count(),
    'Failed' => $students->where('grade', 'Failed')->count(),
    'Not Promoted' => $students->where('grade', 'Not Promoted')->count(),
    ];


        // Return a view with the list of students and grade counts
        return view('students.school_results', [
            'students' => $students,
            'school_code' => $request->school_code,
            'gradeCounts' => $gradeCounts
        ]);
    }

    // Download the result as PDF
    public function download($roll_number)
{
    // Log the start time
    $start = microtime(true);

    // Find the student by roll number
    $student = Student::where('roll_number', $roll_number)->first();

    if (!$student) {
        return redirect()->back()->with('error', 'Student not found.');
    }

    // Initialize the Arabic shaping class
    $arabic = new \ArPHP\I18N\Arabic('Glyphs'); // Make sure to use the proper namespace

    // Calculate total marks, treating 'غ' (absent) as 0
    $student->total_marks = collect($student->subjects)->sum(function ($subject) {
        return $subject['marks'] === 'غ' ? 0 : $subject['marks'];
    });

    // Log time for student data processing
    Log::info('Time after fetching student data: ' . (microtime(true) - $start) . ' seconds');

    // Load the PDF view and pass the Arabic instance as well
    $pdf = Pdf::loadView('students.pdf_result', compact('student', 'arabic'))->setPaper('a4', 'portrait');

    // Log time after PDF generation
    Log::info('Time after PDF generation: ' . (microtime(true) - $start) . ' seconds');

    // Return the PDF for download
    return $pdf->download('result_' . $student->roll_number . '.pdf');
}

}
