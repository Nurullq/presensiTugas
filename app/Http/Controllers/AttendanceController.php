<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        // Mengambil semua data siswa
        $students = Student::all();

        // Mengambil data absensi hari ini
        $today = Carbon::today()->toDateString();
        $attendances = Attendance::whereDate('date', $today)->with('student')->get();

        return view('attendance.index', compact('students', 'attendances'));
    }

    public function store(Request $request)
    {
        // Menyimpan data absensi
        foreach ($request->attendance as $student_id => $status) {
            Attendance::create([
                'student_id' => $student_id,
                'date' => now(),
                'status' => $status,
            ]);
        }

        session()->flash('success', 'Data absensi telah berhasil disimpan!');

        return redirect()->route('attendance.index');
    }

    public function edit($id)
    {
        // Ambil data absensi berdasarkan ID
        $attendance = Attendance::find($id);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        // Validasi dan update status absensi
        $request->validate([
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance = Attendance::find($id);
        $attendance->update([
            'status' => $request->status,
        ]);

        session()->flash('success', 'Absensi berhasil diupdate!');

        // Redirect kembali ke halaman absensi
        return redirect()->route('attendance.index');
    }

    public function destroy($id)
    {
        // Mencari data absensi berdasarkan ID
        $attendance = Attendance::findOrFail($id);

        // Menghapus data absensi
        $attendance->delete();

        // Memberikan pesan sukses
        session()->flash('success', 'Absensi berhasil dihapus!');

        // Redirect kembali ke halaman absensi
        return redirect()->route('attendance.index');
    }
}
