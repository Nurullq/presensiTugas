<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
{
    $students = Student::all();
    return view('attendance.index', compact('students'));
}

public function store(Request $request)
{
    foreach ($request->attendance as $studentId => $status) {
        Attendance::create([
            'student_id' => $studentId,
            'date' => now(),
            'status' => $status,
        ]);
    }
    return redirect()->route('attendance.index');
}

}




