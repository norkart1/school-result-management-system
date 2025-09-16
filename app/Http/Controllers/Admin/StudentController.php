<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'roll_number' => 'required|string|unique:students,roll_number',
            'name' => 'required|string|max:255',
            'school_code' => 'required|string|max:50',
            'category_code' => 'required|string|max:50',
            'grade' => 'required|string|max:15',
            'subject_names' => 'required|array|min:1',
            'subject_names.*' => 'required|string|max:100',
            'subject_marks' => 'required|array|min:1',
            'subject_marks.*' => 'required|numeric|min:0|max:100',
        ]);

        // Build subjects array
        $subjects = [];
        $totalMarks = 0;

        for ($i = 0; $i < count($request->subject_names); $i++) {
            if (!empty($request->subject_names[$i]) && isset($request->subject_marks[$i])) {
                $marks = $request->subject_marks[$i];
                $subjects[] = [
                    'name' => $request->subject_names[$i],
                    'marks' => $marks
                ];
                $totalMarks += $marks;
            }
        }

        // Create the student
        Student::create([
            'roll_number' => $request->roll_number,
            'name' => $request->name,
            'school_code' => $request->school_code,
            'category_code' => $request->category_code,
            'subjects' => $subjects,
            'total_marks' => $totalMarks,
            'grade' => $request->grade,
        ]);

        return redirect()->back()->with('success', 'Student added successfully! Roll Number: ' . $request->roll_number);
    }

    /**
     * Show all students by school
     */
    public function listBySchool()
    {
        $schools = Student::select('school_code', DB::raw('COUNT(*) as student_count'))
                         ->groupBy('school_code')
                         ->orderBy('school_code')
                         ->get();

        return view('admin.students.schools', compact('schools'));
    }

    /**
     * Show students from a specific school
     */
    public function showSchool($schoolCode)
    {
        $students = Student::where('school_code', $schoolCode)
                          ->orderBy('roll_number')
                          ->paginate(20);

        $gradeCounts = [
            'Top Plus' => Student::where('school_code', $schoolCode)->where('grade', 'Top Plus')->count(),
            'Distinction' => Student::where('school_code', $schoolCode)->where('grade', 'Distinction')->count(),
            'First Class' => Student::where('school_code', $schoolCode)->where('grade', 'First Class')->count(),
            'Second Class' => Student::where('school_code', $schoolCode)->where('grade', 'Second Class')->count(),
            'Third Class' => Student::where('school_code', $schoolCode)->where('grade', 'Third Class')->count(),
            'Failed' => Student::where('school_code', $schoolCode)->where('grade', 'Failed')->count(),
            'Not Promoted' => Student::where('school_code', $schoolCode)->where('grade', 'Not Promoted')->count(),
        ];

        return view('admin.students.school-detail', compact('students', 'schoolCode', 'gradeCounts'));
    }
}