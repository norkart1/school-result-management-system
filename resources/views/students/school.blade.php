<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by School Code</title>

    @vite('resources/css/style.css')
</head>
<body>
    <div class="app">
        <div class="home">
            <h1>Search Results by School Code</h1>
            
            <form action="{{ route('school.results') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="school_code">Enter School Code:</label>
                    <input type="text" id="school_code" name="school_code" required>
                </div>
                @error('school_code')
                    <div class="err-msg">{{ $message }}</div>
                @enderror
                <input type="submit" value="Search">
            </form>

            @if (session('error'))
                <p style="color: red;">{{ session('error') }}</p>
            @endif
        </div>
    </div>
</body>
</html>
