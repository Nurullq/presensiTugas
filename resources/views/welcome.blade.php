@extends('layouts.app')

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-4">Selamat Datang di Aplikasi Absensi Sekolah</h1>
    <p class="lead">Kelola data siswa dan absensi harian dengan mudah.</p>
    <hr class="my-4">
    <p>Gunakan tombol di bawah ini untuk mulai mengelola data siswa dan absensi.</p>
    <a class="btn btn-primary btn-lg" href="{{ route('students.index') }}" role="button">Data Siswa</a>
    <a class="btn btn-success btn-lg" href="{{ route('attendance.index') }}" role="button">Absensi Harian</a>
</div>
@endsection
