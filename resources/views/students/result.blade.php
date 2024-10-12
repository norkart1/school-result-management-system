<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>

    <!-- Vite: Load compiled style.css -->
    @vite('resources/css/style.css')

    <!-- Use Google Fonts for Arabic and other text -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>
<body>

    <div class="app">
        <div class="home results-view" id="results-section">
            
            <!-- Header Image -->
            <img src="{{ asset('images/header.svg') }}" alt="Header Image" class="responsive-header" id="header-image" style="width: 100%; height: auto;">
            
            <h1>{{ $student->name }}</h1>
            
            <div class="results-details">
                <div class="right">
                    <p><strong>Roll Number:</strong> <span class="value">{{ $student->roll_number }}</span></p>
                    <p><strong>Dars Code:</strong> <span class="value">{{ $student->school_code }}</span></p>
                    <p class="category"><strong>Category:</strong> <span class="value">{{ $student->category_code }}</span></p>
                </div>

                <div class="left">
                    <p><strong>Total Marks:</strong> {{ $student->total_marks }}</p>
                    <p><strong>Grade:</strong> {{ $student->grade }}</p>
                </div>
            </div>
            
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
                            <td>
                                @if($subject['marks'] === 'غ')
                                    {{ 'غ' }} <!-- Display غ for absent -->
                                @elseif($subject['marks'] == 0)
                                    {{ '0' }} <!-- Display 0 if marks are zero -->
                                @else
                                    {{ $subject['marks'] }} <!-- Otherwise, show actual marks -->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Button Section -->
            <div class="button-group" id="button-section">
                <div class="button-container">
                    <a href="#" onclick="printResult()">Print Result</a>
                </div>

                <div class="button-container">
                    <a href="{{ route('students.download', $student->roll_number) }}" target="_blank">Download PDF</a>
                </div>

                <div class="button-container">
                    <a href="{{ route('students.index') }}">Check another result</a>
                </div>
            </div>

            <div class="copyright">
                <p> © SUFFA DARS COORDINATION </p>
            </div>
        </div>
    </div>

    <script>
        function printResult() {
            window.print();
        }

        function downloadAsPDF(event) {
            event.preventDefault();

            // Hide elements for PDF
            document.getElementById('message-section').classList.add('hide-for-pdf');
            document.getElementById('button-section').classList.add('hide-for-pdf');

            var element = document.getElementById('results-section'); // The section to convert to PDF

            var opt = {
                margin:       0.5,
                filename:     'result_{{ $student->roll_number }}.pdf',
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 3, logging: true, useCORS: true }, // Ensures image rendering
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait', textDirection: 'rtl' }
            };

            html2pdf().from(element).set(opt).save().then(function() {
                // Restore elements after PDF is generated
                document.getElementById('message-section').classList.remove('hide-for-pdf');
                document.getElementById('button-section').classList.remove('hide-for-pdf');
            });
        }
    </script>

</body>
</html>
