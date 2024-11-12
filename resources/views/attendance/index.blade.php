@extends('layouts.app')

@section('content')
<h2>Absensi Harian</h2>

<!-- Pesan Flash -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Form Absensi -->
<form action="{{ route('attendance.store') }}" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Status Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->class }}</td>
                <td>
                    <select name="attendance[{{ $student->id }}]" class="form-select" required>
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

<!-- Rekap Absensi Hari Ini -->
@if($attendances->isNotEmpty())
    <h3 class="mt-5">Rekap Absensi Hari Ini ({{ \Carbon\Carbon::today()->format('d M Y') }})</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Status Kehadiran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $attendance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $attendance->student->name }}</td>
                <td>{{ $attendance->student->class }}</td>
                <td>{{ ucfirst($attendance->status) }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <!-- Tombol Delete -->
                    <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus absensi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="mt-5 text-muted">Belum ada data absensi untuk hari ini.</p>
@endif
@endsection
