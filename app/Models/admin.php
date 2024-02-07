<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins' ;


    protected $fillable = [
        'name',
        'username',
        'alamat',
        'password',
    ];

    // Jika nama tabel tidak mengikuti konvensi Laravel, Anda bisa menggunakan properti berikut:
    // protected $table = 'nama_tabel_anda';

    // Jika tidak ingin menggunakan kolom timestamps 'created_at' dan 'updated_at', Anda bisa menonaktifkannya:
    // public $timestamps = false;
}

