<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result PDF</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
        }
        h1, p {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Result for {{ $student->name }}</h1>

    <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
    <p><strong>School Code:</strong> {{ $student->school_code }}</p>
    <p><strong>Category:</strong> {{ $student->category_code }}</p>
    <p><strong>Total Marks:</strong> {{ $student->total_marks }}</p>
    <p><strong>Grade:</strong> {{ $student->grade }}</p>

    <h3>Subject Marks:</h3>
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->subjects as $subject)
                <tr>
                    <td>{{ $subject['subject'] }}</td>
                    <td>{{ $subject['marks'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
