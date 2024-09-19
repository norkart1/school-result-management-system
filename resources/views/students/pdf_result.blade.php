<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result PDF</title>
    <style>
       /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Tajawal', sans-serif; /* Ensure Tajawal is used for both English and Arabic */
}

body {
        font-family: 'Tajawal', sans-serif;
        direction: rtl; /* Ensure right-to-left direction for Arabic text */
        text-align: right; /* Align text to the right */
    }

    .results-table th, .results-table td {
        text-align: right; /* Ensure table data is right-aligned for Arabic */
    }

    h1, h3 {
        text-align: center; /* Center align headings */
    }

/* Container */
.results-view {
    font-family: 'Tajawal', sans-serif;
    background-color: #ffffff;
    border-radius: 16px;
    padding: 30px;
    max-width: 800px;
    margin: 0 auto;
    color: #333;
    text-align: center; /* Centered text for headings */
}

/* Headings */
.results-view h1 {
    font-size: 28px;
    margin-bottom: 20px;
    color: #108775;
    text-align: center;
}

.results-view p {
    font-size: 16px;
    margin-bottom: 10px;
    color: #333;
    text-align: right; /* Align text to the right for Arabic */
}

/* Subject Marks Table */
.results-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
}

.results-table th, .results-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    font-size: 14px;
    text-align: right; /* Align text to the right for RTL content */
    font-family: 'Tajawal', sans-serif; /* Ensure Tajawal font is applied */
}

.results-table th {
    background-color: #108775; /* Use a solid color for better mPDF compatibility */
    color: #ffffff;
    font-size: 16px;
}

.results-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.results-table tr:hover {
    background-color: #f1f1f1;
    transition: background-color 0.3s ease;
}

/* Responsive behavior is generally not needed for PDFs */

/* Button Group (Won't be used in PDF but included for consistency) */
.results-view .button-group {
    display: none; /* Hide buttons in PDF */
}

/* Message Box (Hidden in PDF) */
.message {
    display: none;
}

/* Footer */
.results-view .copyright {
    text-align: center;
    font-size: 14px;
    color: #333;
    margin-top: 20px;
    font-family: 'Tajawal', sans-serif;
}

.copyright {
    text-align: center; /* Center the text */
    font-size: 14px; /* Adjust font size as needed */
    color: #333; /* Set the text color */
    margin-top: 20px; /* Add some space above the copyright text */
    font-family: 'Tajawal', sans-serif; /* Ensure Tajawal font is applied */
}


/* Table Styling */
.school-results-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
    border-spacing: 0;
}

.school-results-table th, .school-results-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
    font-family: 'Tajawal', sans-serif;
    font-size: 14px;
}

.school-results-table th {
    background-color: #108775; /* Solid color for mPDF compatibility */
    color: #ffffff;
    font-size: 16px;
}

.school-results-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.school-results-table tr:hover {
    background-color: #f1f1f1;
    transition: background-color 0.3s ease;
}

/* Table Borders for PDF */
.results-table th:first-child, .results-table td:first-child {
    border-left: 1px solid #ddd;
}

.results-table th:last-child, .results-table td:last-child {
    border-right: 1px solid #ddd;
}

.results-table th:first-child {
    border-top-left-radius: 12px;
}

.results-table th:last-child {
    border-top-right-radius: 12px;
}

.results-table tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}

.results-table tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}

    </style>
</head>
<body>
    <div class="results-view">
        <img src="{{ asset('images/header.svg') }}" alt="Header Image" class="responsive-header">
        <h1>{{ $student->name }}</h1>
        <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
        <p><strong>School Code:</strong> {{ $student->school_code }}</p>
        <p><strong>Category:</strong> {{ $student->category_code }}</p>
        <p><strong>Total Marks:</strong> {{ $student->total_marks }}</p>
        <p><strong>Grade:</strong> {{ $student->grade }}</p>

        <h3>Subject Marks:</h3>
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

        <div class="copyright">
            <p>© SUFFA DARS COORDINATION</p>
        </div>
        
    </div>
</body>
</html>
