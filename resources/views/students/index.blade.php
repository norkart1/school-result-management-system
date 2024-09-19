<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Exam Results</title>
    
    <!-- Link the compiled CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <!-- Vite CSS -->
     @vite('resources/css/style.css')
</head>
<body>
    <div class="app">
        <div class="home">
            <h1>Check Your Exam Results</h1>

            @if (session('error'))
                <div class="err-msg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('students.search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="roll_number">Enter your Roll Number:</label>
                    <input type="text" id="roll_number" name="roll_number" value="{{ old('roll_number') }}" placeholder="Enter Roll Number" required>
                </div>
                @error('roll_number')
                    <div class="err-msg">{{ $message }}</div>
                @enderror
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
</body>
</html>
