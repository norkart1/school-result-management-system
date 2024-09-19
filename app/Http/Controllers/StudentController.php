<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; // Assuming you have a Student model
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
}
