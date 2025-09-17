<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Details - {{ $schoolCode }}</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <!-- Navigation -->
    <nav style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; margin-bottom: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="color: white; margin: 0; font-size: 1.5rem;">School: {{ $schoolCode }}</h1>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('admin.schools') }}" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">← Back to Schools</a>
                <a href="/admin/dashboard" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">Dashboard</a>
            </div>
        </div>
    </nav>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        
        <!-- School Statistics -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
            <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                <h3 style="margin: 0; color: #007bff; font-size: 2rem;">{{ $students->total() }}</h3>
                <p style="margin: 0.5rem 0 0 0; color: #666;">Total Students</p>
            </div>
            @foreach($gradeCounts as $grade => $count)
                @if($count > 0)
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                        <h3 style="margin: 0; color: #28a745; font-size: 1.5rem;">{{ $count }}</h3>
                        <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.9rem;">{{ $grade }}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Grade Distribution Chart -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h3 style="margin: 0 0 1.5rem 0; color: #333;">Grade Distribution</h3>
            <div style="display: grid; gap: 0.5rem;">
                @foreach($gradeCounts as $grade => $count)
                    @php
                        $percentage = $students->total() > 0 ? round(($count / $students->total()) * 100, 1) : 0;
                        $colors = [
                            'Top Plus' => '#28a745',
                            'Distinction' => '#17a2b8', 
                            'First Class' => '#007bff',
                            'Second Class' => '#ffc107',
                            'Third Class' => '#fd7e14',
                            'Failed' => '#dc3545',
                            'Not Promoted' => '#6c757d'
                        ];
                        $color = $colors[$grade] ?? '#6c757d';
                    @endphp
                    @if($count > 0)
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="width: 120px; font-size: 0.9rem; color: #666;">{{ $grade }}</div>
                            <div style="flex: 1; background: #f8f9fa; border-radius: 10px; overflow: hidden;">
                                <div style="background: {{ $color }}; height: 25px; width: {{ $percentage }}%; display: flex; align-items: center; justify-content: flex-end; padding-right: 0.5rem; color: white; font-size: 0.8rem; font-weight: 500;">
                                    @if($percentage > 10){{ $percentage }}%@endif
                                </div>
                            </div>
                            <div style="width: 60px; text-align: right; font-weight: 600; color: {{ $color }};">{{ $count }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Students List -->
        <div style="background: white; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #f8f9fa;">
                <h3 style="margin: 0; color: #333;">Students ({{ $students->total() }} total)</h3>
            </div>
            
            @if($students->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Roll Number</th>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Name</th>
                                <th style="padding: 1rem; text-align: left; border-bottom: 1px solid #dee2e6;">Category</th>
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
                                    <td style="padding: 1rem;">{{ $student->category_code }}</td>
                                    <td style="padding: 1rem;">
                                        @php
                                            $gradeColors = [
                                                'Top Plus' => '#28a745',
                                                'Distinction' => '#17a2b8', 
                                                'First Class' => '#007bff',
                                                'Second Class' => '#ffc107',
                                                'Third Class' => '#fd7e14',
                                                'Failed' => '#dc3545',
                                                'Not Promoted' => '#6c757d'
                                            ];
                                            $gradeColor = $gradeColors[$student->grade] ?? '#6c757d';
                                        @endphp
                                        <span style="padding: 0.25rem 0.5rem; background: {{ $gradeColor }}20; color: {{ $gradeColor }}; border-radius: 3px; font-size: 0.875rem; font-weight: 500;">
                                            {{ $student->grade }}
                                        </span>
                                    </td>
                                    <td style="padding: 1rem; font-weight: 500;">{{ $student->total_marks }}</td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                            <a 
                                                href="{{ route('admin.students.show', $student) }}" 
                                                style="background: #007bff; color: white; padding: 0.5rem; border-radius: 3px; text-decoration: none; font-size: 0.875rem;"
                                            >
                                                View
                                            </a>
                                            <a 
                                                href="{{ route('students.download', $student->roll_number) }}" 
                                                style="background: #17a2b8; color: white; padding: 0.5rem; border-radius: 3px; text-decoration: none; font-size: 0.875rem;"
                                                target="_blank"
                                            >
                                                PDF
                                            </a>
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
                    <h3 style="margin: 0 0 1rem 0;">No students found in this school</h3>
                    <p style="margin: 0;">This school doesn't have any students yet.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>