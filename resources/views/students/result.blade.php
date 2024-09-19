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
            <h1> {{ $student->name }}</h1>

            <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
            <p><strong>School Code:</strong> {{ $student->school_code }}</p>
            <p><strong>Category:</strong> {{ $student->category_code }}</p>
            <p><strong>Total Marks:</strong> {{ $student->total_marks }}</p>
            <p><strong>Grade:</strong> {{ $student->grade }}</p>

            {{-- <h3>Subjects and Marks</h3> --}}
            
<table class="results-table">
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

<div class="message">
<p>
    
وهذا نتيجة لعملك الجاد وجهودك،
التي قمت بتحضيرها كثيرًا للامتحان للحصول على أفضل النتائج في هذا الاختبار.
هنا قمنا بنشر نتائج ما كسبته وما كتبته في أوراق الامتحان وقت الامتحان.
لذا استمر في ذلك وابذل قصارى جهدك من الآن من أجل مستقبل أفضل.

</p>
</div>

<div class="button-group">
    <div class="button-container">
        <a href="#" onclick="printResult()">Print Result</a>
    </div>

    <div class="button-container">
        <a href="{{ route('students.download', ['roll_number' => $student->roll_number]) }}">Download</a>
    </div>

    <div class="button-container">
        <a href="{{ route('students.index') }}">Check another result</a>
    </div>
</div>

<script>
    function printResult() {
        window.print();
    }
    </script>

<div class="copyright">
    <p> © SUFFA DARS COORDINATION </P></div>


{{-- result view box end here --}}
        </div>
    </div>
</body>
</html>
