<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dars Results for {{ $school_code }} - Suffa Dars Coordination </title>

    <!-- Vite: Load compiled style.css -->
    @vite('resources/css/style.css')

    <!-- Use Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="home school-results-view">
            <img src="{{ asset('images/header.svg') }}" alt="Header Image" class="responsive-header">
            <h1>Results for Dars Code: {{ $school_code }}</h1>

            <table class="school-results-table">
                <thead>
                    <tr>
                        <th>Subjects</th>
                        <th>Grade</th>
                        <th>Total Marks</th>
                        <th>Class</th>
                        <th>Name</th>
                        <th>Roll Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                <ul>
                                    @foreach ($student->subjects as $subject)
                                        <li>{{ $subject['subject'] }}: {{ $subject['marks'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $student->grade }}</td>
                            <td>{{ $student->total_marks }}</td>
                            <td>{{ $student->category_code }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->roll_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <div class="button-group">
                <div class="button-container">
                    <a href="{{ route('students.index') }}">Check Another Result</a>
                </div>
                
            </div>

            <div class="copyright">
                <p>© SUFFA DARS COORDINATION</p>
            </div>
        </div>
    </div>
</body>
</html>
