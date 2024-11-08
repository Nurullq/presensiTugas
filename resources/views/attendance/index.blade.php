@extends('layouts.app')

@section('content')
<h1>Absensi Harian</h1>
<form action="{{ route('attendance.store') }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->class }}</td>
                    <td>
                        <select name="attendance[{{ $student->id }}]" class="form-select">
                            <option value="present">Hadir</option>
                            <option value="absent">Tidak Hadir</option>
                            <option value="late">Terlambat</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-success">Simpan Absensi</button>
</form>
@endsection
