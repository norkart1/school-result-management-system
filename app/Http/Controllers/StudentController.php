<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

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
            return redirect()->back()->with('error', 'No students found for this school code.');
        }

        // Return a view with the list of students
        return view('students.school_results', ['students' => $students, 'school_code' => $request->school_code]);
    }
}
