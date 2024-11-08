@extends('layouts.app')

@section('content')
<h1>Daftar Siswa</h1>
<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama Siswa" required>
    <input type="text" name="class" placeholder="Kelas" required>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
<ul>
    @foreach($students as $student)
        <li>{{ $student->name }} - {{ $student->class }}</li>
    @endforeach
</ul>
@endsection
