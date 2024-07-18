<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'referensi',
        'referensi_pdf',
    ];
}
