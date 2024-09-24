<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf; // Import the mPDF class
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf; // Import the DomPDF facade

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

        // Search the student by roll number
        $student = Student::where('roll_number', $request->roll_number)->first();

        if (!$student) {
            // If student is not found, return a message
            return redirect()->back()->with('error', 'Student not found.');
        }

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
    
        // If no students found, return an error message
        if ($students->isEmpty()) {
            return redirect()->back()->with('error', 'No school found in this school code.');
        }
    
        // Grade counts
        $gradeCounts = [
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
// Method to generate and download PDF


public function download($roll_number)
{
    // Find the student by roll number
    $student = Student::where('roll_number', $roll_number)->first();

    if (!$student) {
        return redirect()->back()->with('error', 'Student not found.');
    }

    // Load the view file for generating the PDF, passing the student data
    $html = view('students.pdf_result', compact('student'))->render();

    // Create a new instance of mPDF with RTL support
    $mpdf = new Mpdf([
        'mode' => 'utf-8', // Ensure the encoding is set to UTF-8 for Arabic support
        'format' => 'A4',
        'orientation' => 'P',
        'default_font' => 'Tajawal', // Ensure the Arabic font
        'directionality' => 'rtl', // Set the text direction to RTL
        'autoScriptToLang' => true, // Enable auto script language detection
        'autoLangToFont' => true,  // Enable automatic language to font assignment
    ]);

    // Explicitly set RTL direction for the PDF
    $mpdf->SetDirectionality('rtl');
    
    // Write the HTML content to the PDF
    $mpdf->WriteHTML($html);

    // Set the filename for the PDF
    $filename = 'result_' . $student->roll_number . '.pdf';

    // Output the PDF to download
    return $mpdf->Output($filename, 'D'); // 'D' will force download
}

}