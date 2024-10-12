<?php

use \ArPHP\I18N\Arabic; // Ensure the correct namespace

// Initialize ArPHP Arabic shaping library
$arabic = new Arabic('Glyphs');

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>

    <style>
        /* Import Custom Fonts */
        @font-face {
            font-family: 'Amiri';
            src: url('{{ public_path('fonts/Amiri-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Amiri';
            src: url('{{ public_path('fonts/Amiri-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        @font-face {
            font-family: 'Tajawal';
            src: url('{{ public_path('fonts/Tajawal-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Raleway';
            src: url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');
            font-weight: normal;
            font-style: normal;
        }

        /* General Styles */
        body {
            font-family: 'Amiri', sans-serif;
            direction: rtl;
            background-color: #ffffff;
            padding: 20px;
            color: #333;
        }

        /* Header Styling */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 100%;
            height: auto;
        }

        h1 {
            font-family: 'Amiri', sans-serif;
            font-size: 35px; /* Slightly increased for student name */
            color: #108775;
            margin-bottom: 10px;
            text-align: center;
        }

        /* Results Details */
        .results-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .results-details .left, .results-details .right {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .results-details .left p,
        .results-details .right p {
            font-size: 16px; /* Uniform font size for all titles */
            margin-bottom: 10px;
            color: #333;
        }

        .results-details .left p {
            text-align: left;
            font-family: 'Tajawal', sans-serif;
        }

        /* Align right values first, label second */
        .results-details .right p {
            text-align: right;
            direction: rtl;
            font-family: 'Tajawal', sans-serif;
        }

        /* Title styling for right column */
        .results-details .right p strong {
            font-family: 'Raleway', sans-serif; /* Set titles to Raleway */
            font-weight: bold; /* Keep bold */
            color: #333;
        }

        /* Value styling for right column */
        .results-details .right p .value {
            font-weight: normal; /* Set values to normal */
            color: #000000; /* Values in black */
        }

        .results-details .right p .label {
            display: inline-block;
            margin-left: 10px;
            width: auto;
            font-family: 'Raleway', sans-serif; /* Use Raleway for titles */
            font-weight: bold;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
            font-family: 'Tajawal', sans-serif;
            table-layout: fixed;
        }

        table th, table td {
            padding: 8px 10px; /* Reduced padding for smaller row height */
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd; /* Narrow stroke lines */
        }

        /* Column width adjustments */
        table th:nth-child(1), table td:nth-child(1) {
            width: 15%; /* 15% for marks column */
        }

        table th:nth-child(2), table td:nth-child(2) {
            width: 85%; /* 85% for subjects column */
        }

        /* Dark Gradient background color for table header */
        table th {
            background-color: #2F4960;
            background-image: linear-gradient(to bottom, #00BC7E, #108775);
            color: white;
        }

        /* Apply border-radius to specific opposite corners */
        table th:first-child {
            border-top-left-radius: 12px; /* Top-left for subject */
        }

        table th:last-child {
            border-top-right-radius: 12px; /* Top-right for marks */
        }

        table tr:last-child td:first-child {
            border-bottom-left-radius: 12px; /* Bottom-left for subject */
        }

        table tr:last-child td:last-child {
            border-bottom-right-radius: 12px; /* Bottom-right for marks */
        }

        /* Even row background color */
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
            color: #333;
            font-family: 'Tajawal', sans-serif;
        }

        .footer p {
            margin: 0;
        }

        /* Adjust line height */
        body, p, table td {
            line-height: 1.2;
        }

        /* Reduce margin and padding to fit single page */
        .results-details p {
            margin: 5px 0;
        }

        /* Hide unwanted elements for printing */
        @media print {
            .footer {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Add the header image -->
    <div class="header">
        <img src="{{ public_path('images/header.png') }}" alt="Header Image" style="width: 100%; height: auto;">
    </div>

    <h1>{{ $arabic->utf8Glyphs($student->name) }}</h1>

    <div class="results-details">
        <div class="left">
            <p><strong>Total Marks:</strong> {{ $student->total_marks }}</p>
            <p><strong>Grade:</strong> {{ $arabic->utf8Glyphs($student->grade) }}</p>
        </div>
        <div class="right">
            <p><span class="value">{{ $student->roll_number }}</span><span class="label">:Roll Number</span></p>
            <p><span class="value">{{ $student->school_code }}</span><span class="label">:Dars Code</span></p>
            <p><span class="value">{{ $arabic->utf8Glyphs($student->category_code) }}</span><span class="label">:Category</span></p>
        </div>
    </div>

    <table class="results-table">
        <thead>
            <tr>
                <th>Marks</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student->subjects as $subject)
                <tr>
                    <td>{{ $subject['marks'] == 0 ? '0' : $subject['marks'] }}</td>
                    <td>{{ $arabic->utf8Glyphs($subject['subject']) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>© SUFFA DARS COORDINATION</p>
    </div>

</body>
</html>
