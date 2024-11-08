<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'class']; // Kolom yang bisa diisi secara massal

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
