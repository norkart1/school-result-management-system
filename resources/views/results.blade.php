<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>

    <!-- Vite: Load compiled style.css -->
    @vite('resources/css/style.css')

    <!-- Use Google Fonts for Arabic and other text -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="home results-view">
            <h1>Exam Results for {{ $student->name }}</h1>

            <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
            <p><strong>School Code:</strong> {{ $student->school_code }}</p>
            <p><strong>Category:</strong> {{ $student->category_code }}</p>
            <p><strong>Total Marks:</strong> {{ $student->total_marks }}</p>
            <p><strong>Grade:</strong> {{ $student->grade }}</p>

            <h3>Subjects and Marks</h3>
            <ul>
                @foreach (json_decode($student->subjects, true) as $subject)
                    <li>{{ $subject['subject'] }}: {{ $subject['marks'] }}</li>
                @endforeach
            </ul>

            <a href="{{ url('/') }}">Search Again</a>
        </div>
    </div>
</body>
</html>
