<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = [
        'nama',
        'keturunan_ke',
        'bani',
        'alamat',
        'hp',
        'pekerjaan',
    ];

    // Tambahkan relasi atau metode lain jika diperlukan
}
