<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details - {{ $student->name }}</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <!-- Navigation -->
    <nav style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; margin-bottom: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="color: white; margin: 0; font-size: 1.5rem;">Student Details</h1>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('admin.students.index') }}" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">← Back to Students</a>
                <a href="/admin/dashboard" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">Dashboard</a>
            </div>
        </div>
    </nav>

    <div style="max-width: 1000px; margin: 0 auto; padding: 0 2rem;">
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: 5px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Action Buttons -->
        <div style="display: flex; gap: 1rem; margin-bottom: 2rem; justify-content: flex-end;">
            <a 
                href="{{ route('admin.students.edit', $student) }}" 
                style="background: #ffc107; color: #212529; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px; font-weight: 500;"
            >
                Edit Student
            </a>
            <a 
                href="{{ route('students.download', $student->roll_number) }}" 
                style="background: #17a2b8; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px; font-weight: 500;"
                target="_blank"
            >
                Download PDF
            </a>
            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this student?')">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    style="background: #dc3545; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; cursor: pointer; font-weight: 500;"
                >
                    Delete Student
                </button>
            </form>
        </div>

        <!-- Student Information -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h2 style="margin: 0 0 1.5rem 0; color: #333; border-bottom: 2px solid #f8f9fa; padding-bottom: 1rem;">Student Information</h2>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div>
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Roll Number</label>
                    <p style="margin: 0; padding: 0.75rem; background: #f8f9fa; border-radius: 5px; font-size: 1.1rem; font-weight: 500;">{{ $student->roll_number }}</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Student Name</label>
                    <p style="margin: 0; padding: 0.75rem; background: #f8f9fa; border-radius: 5px; font-size: 1.1rem;">{{ $student->name }}</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 0.5rem;">School Code</label>
                    <p style="margin: 0; padding: 0.75rem; background: #f8f9fa; border-radius: 5px;">{{ $student->school_code }}</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Category Code</label>
                    <p style="margin: 0; padding: 0.75rem; background: #f8f9fa; border-radius: 5px;">{{ $student->category_code }}</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Grade</label>
                    <p style="margin: 0; padding: 0.75rem; background: #e3f2fd; color: #1976d2; border-radius: 5px; font-weight: 500;">{{ $student->grade }}</p>
                </div>
                
                <div>
                    <label style="display: block; font-weight: 600; color: #666; margin-bottom: 0.5rem;">Total Marks</label>
                    <p style="margin: 0; padding: 0.75rem; background: #e8f5e8; color: #2e7d32; border-radius: 5px; font-weight: 500; font-size: 1.1rem;">{{ $student->total_marks }}</p>
                </div>
            </div>
        </div>

        <!-- Subjects and Marks -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="margin: 0 0 1.5rem 0; color: #333; border-bottom: 2px solid #f8f9fa; padding-bottom: 1rem;">Subjects and Marks</h2>
            
            @if(!empty($student->subjects) && is_array($student->subjects))
                <div style="display: grid; gap: 1rem;">
                    @foreach($student->subjects as $index => $subject)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; background: #f8f9fa; border-radius: 5px; border-left: 4px solid #667eea;">
                            <div>
                                <h4 style="margin: 0 0 0.25rem 0; color: #333; font-size: 1.1rem;">{{ $subject['name'] ?? 'Subject ' . ($index + 1) }}</h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Subject {{ $index + 1 }}</p>
                            </div>
                            <div style="text-align: right;">
                                <span style="font-size: 1.5rem; font-weight: 600; color: #2e7d32;">{{ $subject['marks'] ?? 0 }}</span>
                                <span style="color: #666; font-size: 0.9rem;">/100</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Summary -->
                <div style="margin-top: 2rem; padding: 1.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; color: white;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h3 style="margin: 0 0 0.5rem 0;">Summary</h3>
                            <p style="margin: 0; opacity: 0.9;">Total subjects: {{ count($student->subjects) }}</p>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-size: 2rem; font-weight: bold;">{{ $student->total_marks }}</div>
                            <div style="opacity: 0.9;">Total Marks</div>
                        </div>
                    </div>
                </div>
            @else
                <div style="text-align: center; padding: 2rem; color: #666;">
                    <p style="margin: 0;">No subjects available for this student.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>