<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons';
    protected $fillable = [
        'nama',
        'nama_orang_tua',
        'bani',
        'alamat',
        'hp',
        'pekerjaan',
        'is_menantu',
    ];

    // Tambahkan relasi atau metode lain jika diperlukan
}
