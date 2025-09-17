<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <!-- Navigation -->
    <nav style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; margin-bottom: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="color: white; margin: 0; font-size: 1.5rem;">Manage Students</h1>
            <a href="/admin/dashboard" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">← Back to Dashboard</a>
        </div>
    </nav>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: 5px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Actions Bar -->
        <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                <div style="flex: 1;">
                    <form method="GET" style="display: flex; gap: 1rem; align-items: center;">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search by name, roll number, or school code..." 
                            value="{{ request('search') }}"
                            style="flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px;"
                        >
                        <button 
                            type="submit" 
                            style="background: #007bff; color: white; padding: 0.75rem 1.5rem; border: none; border-radius: 5px; cursor: pointer;"
                        >
                            Search
                        </button>
                        @if(request('search'))
                            <a 
                                href="{{ route('admin.students.index') }}" 
                                style="background: #6c757d; color: white; padding: 0.75rem 1rem; text-decoration: none; border-radius: 5px;"
                            >
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
                <a 
                    href="{{ route('admin.students.create') }}" 
                    style="background: #28a745; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px; white-space: nowrap;"
                >
                    + Add Student
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                <h3 style="margin: 0; color: #007bff; font-size: 2rem;">{{ $totalStudents }}</h3>
                <p style="margin: 0.5rem 0 0 0; color: #666;">Total Students</p>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                <h3 style="margin: 0; color: #28a745; font-size: 2rem;">{{ $students->count() }}</h3>
                <p style="margin: 0.5rem 0 0 0; color: #666;">{{ request('search') ? 'Search Results' : 'Showing' }}</p>
            </div>
        </div>

        <!-- Students Table -->
        <div style="background: white; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            @if($students->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Roll Number</th>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Name</th>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">School</th>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Grade</th>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Total Marks</th>
                                <th style="padding: 1rem; text-align: center; border-bottom: 1px solid #dee2e6;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr style="border-bottom: 1px solid #f8f9fa;">
                                    <td style="padding: 1rem;">{{ $student->roll_number }}</td>
                                    <td style="padding: 1rem;">{{ $student->name }}</td>
                                    <td style="padding: 1rem;">{{ $student->school_code }}</td>
                                    <td style="padding: 1rem;">
                                        <span style="padding: 0.25rem 0.5rem; background: #e3f2fd; color: #1976d2; border-radius: 3px; font-size: 0.875rem;">
                                            {{ $student->grade }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem;">{{ $student->total_marks }}</td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <a 
                                                href="{{ route('admin.students.show', $student) }}" 
                                                style="background: #007bff; color: white; padding: 0.5rem; border-radius: 3px; text-decoration: none; font-size: 0.875rem;"
                                            >
                                                View
                                            </a>
                                            <a 
                                                href="{{ route('admin.students.edit', $student) }}" 
                                                style="background: #ffc107; color: #212529; padding: 0.5rem; border-radius: 3px; text-decoration: none; font-size: 0.875rem;"
                                            >
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.students.destroy', $student) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this student?')">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    style="background: #dc3545; color: white; padding: 0.5rem; border: none; border-radius: 3px; cursor: pointer; font-size: 0.875rem;"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($students->hasPages())
                    <div style="padding: 1rem; border-top: 1px solid #dee2e6;">
                        {{ $students->links() }}
                    </div>
                @endif
                
            @else
                <div style="padding: 3rem; text-align: center; color: #666;">
                    <h3 style="margin: 0 0 1rem 0;">No students found</h3>
                    @if(request('search'))
                        <p style="margin: 0;">No students match your search criteria.</p>
                    @else
                        <p style="margin: 0 0 1rem 0;">Get started by adding your first student.</p>
                        <a 
                            href="{{ route('admin.students.create') }}" 
                            style="background: #28a745; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px;"
                        >
                            Add First Student
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</body>
</html>