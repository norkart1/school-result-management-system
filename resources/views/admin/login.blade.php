<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 100%; max-width: 400px;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="color: #333; margin: 0;">Admin Login</h2>
            <p style="color: #666; margin: 0.5rem 0 0 0;">Enter your credentials to access admin panel</p>
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            
            <!-- Username Field -->
            <div style="margin-bottom: 1rem;">
                <label for="username" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    value="{{ old('username') }}" 
                    required 
                    style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; box-sizing: border-box;"
                >
                @error('username')
                    <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div style="margin-bottom: 1.5rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem; box-sizing: border-box;"
                >
                @error('password')
                    <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                style="width: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.75rem; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; font-weight: 500;"
            >
                Login
            </button>
        </form>

        <div style="text-align: center; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #eee;">
            <a href="/" style="color: #667eea; text-decoration: none; font-size: 0.875rem;">← Back to Student Portal</a>
        </div>
    </div>
</body>
</html>