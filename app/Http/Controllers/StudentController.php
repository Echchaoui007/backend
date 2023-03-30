<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Models\Student;
    use Illuminate\Http\Request;
    
    class StudentController extends Controller
    {
        public function index()
        {
            $students = Student::all();
            return response()->json($students);
        }
    
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:students',
                'password' => 'required|min:8',
            ]);
    
            $student = Student::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'approved' => false,
            ]);
    
            return response()->json($student, 201);
        }
    
        public function show(Student $student)
        {
            return response()->json($student);
        }
    
        public function update(Request $request, Student $student)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:students,email,' . $student->id,
                'password' => 'sometimes|min:8',
            ]);
    
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->filled('password') ? bcrypt($request->password) : $student->password,
            ]);
    
            return response()->json($student);
        }
    
        public function destroy(Student $student)
        {
            $student->delete();
            return response()->json(null, 204);
        }
        // approve student to log in
        public function approve(Student $student)
        {
            $student->update(['approved' => true]);
            return response()->json($student);
        }

    }
    
