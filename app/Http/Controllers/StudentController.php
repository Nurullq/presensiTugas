<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'class' => 'required|string|max:255',
    ]);

    // Simpan data siswa
    Student::create($request->only('name', 'class'));

    // Tambahkan pesan berhasil ke sesi
    session()->flash('success', 'Data siswa berhasil disimpan!');

    // Redirect kembali ke halaman Data Siswa
    return redirect()->route('students.index');
    }

    //ini fitur delete
    public function destroy($id)
    {
        // Cari siswa berdasarkan ID dan hapus
        $student = Student::findOrFail($id);
        $student->delete();

        session()->flash('success', 'Data siswa berhasil dihapus!');

        return redirect()->route('students.index');
    }
}


