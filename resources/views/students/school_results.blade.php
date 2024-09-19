<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Results for {{ $school_code }}</title>

    @vite('resources/css/style.css')
</head>
<body>
    <div class="app">
        <div class="home results-view">
            <h1>Results for School Code: {{ $school_code }}</h1>

            <table>
                <thead>
                    <tr>
                        <th>Roll Number</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Total Marks</th>
                        <th>Grade</th>
                        <th>Subjects</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->roll_number }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->category_code }}</td>
                            <td>{{ $student->total_marks }}</td>
                            <td>{{ $student->grade }}</td>
                            <td>
                                <ul>
                                    @foreach ($student->subjects as $subject)
                                        <li>{{ $subject['subject'] }}: {{ $subject['marks'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('school.search.form') }}">Search Again</a>
        </div>
    </div>
</body>
</html>
