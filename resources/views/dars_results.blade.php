<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results - Suffa Dars Coordination</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Vite: Load compiled style.css -->
    @vite('resources/css/style.css')

    <!-- Use Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    /* background: url('{{ asset("images/result-bg_two-screen.png") }}') no-repeat center center fixed;
    background-size: cover; */
    font-family: 'Poppins', sans-serif;
}

.result-page {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header Section */
.header {
    text-align: center;
    color: white;
    margin-top: 50px;
}

.header h1 {
    font-size: 36px;
    font-weight: 700;
}

.header h2 {
    font-size: 24px;
    font-weight: 400;
    margin-top: 10px;
}

/* Main Section - Two Cards */
.main-section {
    display: flex;
    justify-content: center;
    gap: 40px;
    padding: 40px 20px;
    margin-top: 40px;
}

.search-card {
    background-color: white;
    border-radius: 16px;
    padding: 30px;
    width: 300px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.search-card h3 {
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: 600;
}

.search-card form {
    display: flex;
    flex-direction: column;
}

.search-card label {
    font-size: 16px;
    margin-bottom: 10px;
    text-align: left;
}

.search-card input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 16px;
}

.search-card button {
    background-color: #2F4960;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-card button:hover {
    background-color: #00BC7E;
}

/* Footer Section */
.footer {
    text-align: center;
    margin-top: auto;
    padding: 20px;
    background-color: transparent;
    color: white;
    font-size: 14px;
}

.footer p {
    margin: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main-section {
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .header h1 {
        font-size: 30px;
    }

    .header h2 {
        font-size: 20px;
    }
}
</style>
</head>
<body>
    <!-- Page Container -->
    <div class="result-page">
        <!-- Header Section -->
        <header class="header">
            <h1>SUFFA DARS COORDINATION</h1>
            <h2>MID TERM EXAM RESULTS</h2>
        </header>

        <!-- Main Section with Two Search Cards -->
        <div class="main-section">
            <!-- Student Wise Search Card -->
            <div class="search-card">
                <h3>Check Your Exam Results</h3>
                <form action="{{ route('students.search') }}" method="POST">
                    @csrf
                    <label for="roll_number">Enter your Roll Number:</label>
                    <input type="text" name="roll_number" id="roll_number" placeholder="Enter Roll Number" required>
                    <button type="submit">Search</button>
                </form>
            </div>

            <!-- School Wise Search Card -->
            <div class="search-card">
                <h3>Search Results by School Code</h3>
                <form action="{{ route('school.results') }}" method="POST">
                    @csrf
                    <label for="school_code">Enter School Code:</label>
                    <input type="text" name="school_code" id="school_code" placeholder="Enter School Code" required>
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <!-- Footer Section -->
        <footer class="footer">
            <p>Powered by Suffa Dars © Alathurpadi Dars</p>
        </footer>
    </div>
</body>
</html>
