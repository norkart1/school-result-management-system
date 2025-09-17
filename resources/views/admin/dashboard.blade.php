<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <!-- Navigation -->
    <nav style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; margin-bottom: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="color: white; margin: 0; font-size: 1.5rem;">Admin Dashboard</h1>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <span style="color: white;">Welcome, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                    @csrf
                    <button 
                        type="submit" 
                        style="background: rgba(255,255,255,0.2); color: white; border: 1px solid white; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer;"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        <!-- Dashboard Stats -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
            <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 1rem 0; color: #333;">System Status</h3>
                <p style="color: #28a745; margin: 0; font-weight: 500;">✓ All systems operational</p>
            </div>
            
            <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 1rem 0; color: #333;">Database</h3>
                <p style="color: #28a745; margin: 0; font-weight: 500;">✓ Connected</p>
            </div>
            
            <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin: 0 0 1rem 0; color: #333;">PDF Generation</h3>
                <p style="color: #28a745; margin: 0; font-weight: 500;">✓ Arabic fonts loaded</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h3 style="margin: 0 0 1.5rem 0; color: #333;">Quick Actions</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <a 
                    href="/admin/students/create" 
                    style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 1rem; text-decoration: none; border-radius: 8px; text-align: center; display: block;"
                >
                    Add New Student
                </a>
                <a 
                    href="/admin/schools" 
                    style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: white; padding: 1rem; text-decoration: none; border-radius: 8px; text-align: center; display: block;"
                >
                    Manage Schools
                </a>
                <a 
                    href="/search-school" 
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem; text-decoration: none; border-radius: 8px; text-align: center; display: block;"
                >
                    School Results
                </a>
                <a 
                    href="/new-form" 
                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 1rem; text-decoration: none; border-radius: 8px; text-align: center; display: block;"
                >
                    Student Search
                </a>
                <a 
                    href="/results" 
                    style="background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%); color: white; padding: 1rem; text-decoration: none; border-radius: 8px; text-align: center; display: block;"
                >
                    Dars Results
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h3 style="margin: 0 0 1.5rem 0; color: #333;">System Information</h3>
            <div style="display: grid; gap: 1rem;">
                <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>Laravel Version:</strong> {{ app()->version() }}
                </div>
                <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>PHP Version:</strong> {{ PHP_VERSION }}
                </div>
                <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>Database:</strong> {{ ucfirst(config('database.default')) }} ({{ DB::connection()->getDriverName() }})
                </div>
                <div style="padding: 1rem; background: #f8f9fa; border-radius: 5px;">
                    <strong>Environment:</strong> {{ config('app.env') }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>