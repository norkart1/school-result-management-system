<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schools Management</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <!-- Navigation -->
    <nav style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; margin-bottom: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="color: white; margin: 0; font-size: 1.5rem;">Schools Management</h1>
            <a href="/admin/dashboard" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">← Back to Dashboard</a>
        </div>
    </nav>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        
        <!-- Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                <h3 style="margin: 0; color: #007bff; font-size: 2rem;">{{ $schools->count() }}</h3>
                <p style="margin: 0.5rem 0 0 0; color: #666;">Total Schools</p>
            </div>
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                <h3 style="margin: 0; color: #28a745; font-size: 2rem;">{{ $schools->sum('student_count') }}</h3>
                <p style="margin: 0.5rem 0 0 0; color: #666;">Total Students</p>
            </div>
        </div>

        <!-- Schools Grid -->
        @if($schools->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                @foreach($schools as $school)
                    <div style="background: white; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;">
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem; color: white;">
                            <h3 style="margin: 0 0 0.5rem 0; font-size: 1.25rem;">{{ $school->school_code }}</h3>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="opacity: 0.9;">School Code</span>
                                <span style="font-size: 1.5rem; font-weight: bold;">{{ $school->student_count }}</span>
                            </div>
                            <p style="margin: 0.25rem 0 0 0; opacity: 0.8; font-size: 0.9rem;">Students enrolled</p>
                        </div>
                        
                        <div style="padding: 1.5rem;">
                            <div style="margin-bottom: 1rem;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                    <span style="color: #666;">Students:</span>
                                    <span style="font-weight: 600; color: #28a745;">{{ $school->student_count }}</span>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 0.5rem;">
                                <a 
                                    href="{{ route('admin.schools.show', $school->school_code) }}" 
                                    style="flex: 1; background: #007bff; color: white; padding: 0.75rem; text-decoration: none; border-radius: 5px; text-align: center; font-weight: 500;"
                                >
                                    View Details
                                </a>
                                <a 
                                    href="{{ route('school.results') }}?school_code={{ $school->school_code }}" 
                                    style="flex: 1; background: #17a2b8; color: white; padding: 0.75rem; text-decoration: none; border-radius: 5px; text-align: center; font-weight: 500;"
                                    target="_blank"
                                >
                                    View Results
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="background: white; padding: 3rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                <h3 style="margin: 0 0 1rem 0; color: #666;">No schools found</h3>
                <p style="margin: 0 0 1rem 0; color: #666;">Schools will appear here once students are added to the system.</p>
                <a 
                    href="{{ route('admin.students.create') }}" 
                    style="background: #28a745; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px; font-weight: 500;"
                >
                    Add First Student
                </a>
            </div>
        @endif
    </div>
</body>
</html>