<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>

    <!-- Vite: Load compiled style.css -->
    @vite('resources/css/style.css')

    <!-- Use Google Fonts for Arabic and other text -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Raleway:wght@300;400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app">
        <div class="home">
            <form action="/results" method="post">
                @csrf
                <label for="roll_number">Enter your Roll Number:</label>
                <input type="text" name="roll_number" id="roll_number" required>
                <button type="submit">Check Result</button>

                @if (session('error'))
                    <p>{{ session('error') }}</p>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
