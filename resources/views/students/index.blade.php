@extends('layouts.app')

@section('content')
<h2>Daftar Siswa</h2>

<!-- Pesan Flash -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Form Tambah Siswa -->
<form action="{{ route('students.store') }}" method="POST" class="mb-3">
    @csrf
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control" placeholder="Nama Siswa" required>
        <input type="text" name="class" class="form-control" placeholder="Kelas" required>
        <button class="btn btn-primary" type="submit">Tambah Siswa</button>
    </div>
</form>

<!-- Tabel Data Siswa -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $index => $student)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->class }}</td>
            <td>
                <!-- Form Delete -->
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
