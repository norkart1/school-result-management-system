<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Form</title>

    <!-- CSS link or use inline style -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&display=swap" rel="stylesheet">

      

    <style>

body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    background-color: #2F4960; /* Full body background color */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.main-container {
    background-color: #ffffff; /* White background for the main container */
    border-radius: 16px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    width: 100%;
    height: auto;
    overflow: hidden;
    display: flex;
}

.footer p {
    margin: 0;
}

.left-section {
    flex: 1;
    background-color: #ffffff;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 50px;
    position: relative;
}

.right-section {
    flex: 1;
    background-image: url('{{ asset('images/gateway-image.jpg') }}');
    background-size: cover;
    background-position: center;
}

.form-container {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}

h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.tab-buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.tab-buttons button {
    flex: 1;
    padding: 10px;
    background-color: transparent;
    border: none;
    border-radius: 16px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    color: #333;
    transition: background-color 0.3s ease;
}

.tab-buttons button.active {
    background-color: #2F4960;
    color: #ffffff;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 16px;
    font-size: 16px;
}

form input[type="submit"] {
    background-color: #2F4960;
    color: #ffffff;
    border: none;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
}

/* Footer Styling */
.footer {
    width: 100%;
    text-align: center;
    font-size: 14px;
    color: #333;
    margin-top: 20px;
    flex-shrink: 0; /* Ensure the footer remains centered */
}

.alert {
    padding: 15px;
    background-color: #f44336; /* Red */
    color: white;
    margin-bottom: 20px;
    border-radius: 8px;
}

.alert-danger {
    background-color: #ffdddd;
    color: #d8000c;
}


/* Mobile View Styling */
@media (max-width: 768px) {
    .main-container {
        flex-direction: column;
    }

    .right-section {
        height: 40vh;
        flex: none;
    }

    .left-section {
        height: 60vh;
        flex: none;
        padding: 30px;

        /* Center content vertically and horizontally in mobile view */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
    }

    .footer {
        margin-top: 20px;
    }
}


    </style>
</head>
<body>

    <div class="main-container">
        <div class="left-section">
            <div class="form-container">
                <h2>Check Your Results</h2>
    
                <!-- Display error message -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
    
                <div class="tab-buttons">
                    <button class="tab-button active" onclick="switchTab(event, 'student-form')">Student Wise</button>
                    <button class="tab-button" onclick="switchTab(event, 'school-form')">School Wise</button>
                </div>
    
                <div id="student-form" class="tab-content active">
                    <form action="{{ route('students.search') }}" method="POST">
                        @csrf
                        <input type="text" name="roll_number" placeholder="Enter Roll Number" required>
                        <input type="submit" value="Search">
                    </form>
                </div>
    
                <div id="school-form" class="tab-content">
                    <form action="{{ route('school.results') }}" method="POST">
                        @csrf
                        <input type="text" name="school_code" placeholder="Enter School Code" required>
                        <input type="submit" value="Search">
                    </form>
                </div>
    
                 <!-- Footer Section -->
            <footer class="footer">
                <p>Powered by Suffa Dars © Alathurpadi Dars</p>
            </footer>
            </div>
    
        </div>
    
        <div class="right-section">
            <!-- The background image will be applied here as a cover -->
        </div>
    </div>
    
    <script>
        function switchTab(event, tabId) {
            let tabs = document.querySelectorAll('.tab-content');
            let buttons = document.querySelectorAll('.tab-button');
    
            tabs.forEach(tab => tab.classList.remove('active'));
            buttons.forEach(button => button.classList.remove('active'));
    
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
    
    </body>
    
</html>
