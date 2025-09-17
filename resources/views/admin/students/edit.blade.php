<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - {{ $student->name }}</title>
    @vite(['resources/css/app.css', 'resources/css/style.css'])
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">
    <!-- Navigation -->
    <nav style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1rem 0; margin-bottom: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h1 style="color: white; margin: 0; font-size: 1.5rem;">Edit Student</h1>
            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('admin.students.show', $student) }}" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">← Back to Student</a>
                <a href="/admin/dashboard" style="color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 5px;">Dashboard</a>
            </div>
        </div>
    </nav>

    <div style="max-width: 800px; margin: 0 auto; padding: 0 2rem;">
        <div style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: 5px; border: 1px solid #c3e6cb;">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.students.update', $student) }}">
                @csrf
                @method('PUT')
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Roll Number</label>
                        <input type="text" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                        @error('roll_number')
                            <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Student Name</label>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                        @error('name')
                            <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">School Code</label>
                        <input type="text" name="school_code" value="{{ old('school_code', $student->school_code) }}" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;"
                               placeholder="e.g., SCH001">
                        @error('school_code')
                            <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Category Code</label>
                        <input type="text" name="category_code" value="{{ old('category_code', $student->category_code) }}" required 
                               style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;"
                               placeholder="e.g., CAT1">
                        @error('category_code')
                            <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Grade</label>
                    <select name="grade" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
                        <option value="">Select Grade</option>
                        <option value="Top Plus" {{ old('grade', $student->grade) == 'Top Plus' ? 'selected' : '' }}>Top Plus</option>
                        <option value="Distinction" {{ old('grade', $student->grade) == 'Distinction' ? 'selected' : '' }}>Distinction</option>
                        <option value="First Class" {{ old('grade', $student->grade) == 'First Class' ? 'selected' : '' }}>First Class</option>
                        <option value="Second Class" {{ old('grade', $student->grade) == 'Second Class' ? 'selected' : '' }}>Second Class</option>
                        <option value="Third Class" {{ old('grade', $student->grade) == 'Third Class' ? 'selected' : '' }}>Third Class</option>
                        <option value="Failed" {{ old('grade', $student->grade) == 'Failed' ? 'selected' : '' }}>Failed</option>
                        <option value="Not Promoted" {{ old('grade', $student->grade) == 'Not Promoted' ? 'selected' : '' }}>Not Promoted</option>
                    </select>
                    @error('grade')
                        <div style="color: #e3342f; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; color: #333; font-weight: 500;">Subjects and Marks</label>
                    <div id="subjects-container">
                        @if(!empty($student->subjects) && is_array($student->subjects))
                            @foreach($student->subjects as $index => $subject)
                                <div class="subject-row" style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 0.5rem; margin-bottom: 0.5rem; align-items: center;">
                                    <input type="text" name="subject_names[]" value="{{ $subject['name'] ?? '' }}" placeholder="Subject Name" 
                                           style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px;">
                                    <input type="number" name="subject_marks[]" value="{{ $subject['marks'] ?? '' }}" placeholder="Marks" min="0" max="100"
                                           style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px;">
                                    <button type="button" onclick="removeSubject(this)" style="background: #dc3545; color: white; border: none; padding: 0.5rem; border-radius: 3px; cursor: pointer;">Remove</button>
                                </div>
                            @endforeach
                        @else
                            <div class="subject-row" style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 0.5rem; margin-bottom: 0.5rem; align-items: center;">
                                <input type="text" name="subject_names[]" placeholder="Subject Name" 
                                       style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px;">
                                <input type="number" name="subject_marks[]" placeholder="Marks" min="0" max="100"
                                       style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px;">
                                <button type="button" onclick="removeSubject(this)" style="background: #dc3545; color: white; border: none; padding: 0.5rem; border-radius: 3px; cursor: pointer;">Remove</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addSubject()" style="background: #28a745; color: white; border: none; padding: 0.5rem 1rem; border-radius: 5px; cursor: pointer; margin-top: 0.5rem;">Add Another Subject</button>
                </div>

                <div style="text-align: center; display: flex; gap: 1rem; justify-content: center;">
                    <button type="submit" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 1rem 2rem; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; font-weight: 500;">
                        Update Student
                    </button>
                    <a href="{{ route('admin.students.show', $student) }}" style="background: #6c757d; color: white; padding: 1rem 2rem; text-decoration: none; border-radius: 5px; font-size: 1rem; font-weight: 500;">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addSubject() {
            const container = document.getElementById('subjects-container');
            const newRow = document.createElement('div');
            newRow.className = 'subject-row';
            newRow.style = 'display: grid; grid-template-columns: 2fr 1fr auto; gap: 0.5rem; margin-bottom: 0.5rem; align-items: center;';
            newRow.innerHTML = `
                <input type="text" name="subject_names[]" placeholder="Subject Name" 
                       style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px;">
                <input type="number" name="subject_marks[]" placeholder="Marks" min="0" max="100"
                       style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 3px;">
                <button type="button" onclick="removeSubject(this)" style="background: #dc3545; color: white; border: none; padding: 0.5rem; border-radius: 3px; cursor: pointer;">Remove</button>
            `;
            container.appendChild(newRow);
        }

        function removeSubject(button) {
            const container = document.getElementById('subjects-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            }
        }
    </script>
</body>
</html>