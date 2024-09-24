<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dars Results for {{ $school_code }} - Suffa Dars Coordination</title>

    <!-- Vite: Load compiled style.css -->
    @vite('resources/css/style.css')

    <!-- Use Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div class="app">
        <div class="home school-results-view" id="results-section">
            <img src="{{ asset('images/header.svg') }}" alt="Header Image" class="responsive-header">

            <h1>Results for Dars Code: {{ $school_code }}</h1>

            <!-- Grade Counts -->
            <div class="grade-counts">
                <p>Distinction: <span>{{ $gradeCounts['Distinction'] }}</span> | 
                   First Class: <span>{{ $gradeCounts['First Class'] }}</span> | 
                   Second Class: <span>{{ $gradeCounts['Second Class'] }}</span> | 
                   Third Class: <span>{{ $gradeCounts['Third Class'] }}</span> | 
                   Failed: <span>{{ $gradeCounts['Failed'] }}</span> | 
                   Not Promoted: <span>{{ $gradeCounts['Not Promoted'] }}</span></p>
            </div>

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
                    <a href="#" onclick="printResult()">Print Result</a>
                </div>

                <div class="button-container">
                    <a href="#" onclick="downloadAsPDF(event)">Download PDF</a>
                </div>

                <div class="button-container">
                    <a href="{{ route('students.index') }}">Check Another Result</a>
                </div>
            </div>

            <div class="copyright">
                <p>© SUFFA DARS COORDINATION</p>
            </div>
        </div>
    </div>

    <script>
        function printResult() {
            window.print();
        }

        function downloadAsPDF(event) {
            event.preventDefault(); // Prevent default link behavior

            // Generate PDF
            var element = document.getElementById('results-section'); // The section to convert to PDF

            var opt = {
                margin: 0.5,
                filename: 'school_results_{{ $school_code }}.pdf',
                image: { type: 'jpeg', quality: 1.0 },
                html2canvas: { scale: 3, logging: true, useCORS: true }, // Ensures image rendering
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait', textDirection: 'rtl' }
            };

            html2pdf().from(element).set(opt).save().then(function() {
                // Optional: If you want to perform any actions after the download
                console.log('PDF Downloaded');
            });
        }
    </script>

</body>
</html>
