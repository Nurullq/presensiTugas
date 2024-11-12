@extends('layouts.app')

@section('content')
<h2>Edit Absensi</h2>

<!-- Pesan Flash -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form action="{{ route('attendance.update', $attendance->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="status" class="form-label">Status Kehadiran</label>
        <select name="status" id="status" class="form-select" required>
            <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Hadir</option>
            <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Tidak Hadir</option>
            <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Terlambat</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Absensi</button>
</form>
@endsection
