<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nip_nrp',
        'nama_lengkap',
        'email',
        'password',
        'no_ktp',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'jabatan',
        'subsaker',
        'photo_profile',
    ];
}
