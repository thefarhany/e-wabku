<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WabkuModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'subsaker',
        'akun',
        'perintah_bayar',
        'program',
        'npwp',
        'no_faktur',
        'no_invoice',
        'tgl_faktur',
        'uraian_wabku',
        'jml_belanja',
        'pdf_pendukung',
        'validasi_bendahara',
        'tgl_validasi_bendahara',
        'pdf_ppk',
        'pdf_ppk_pajak',
        'validasi_ppk',
        'tgl_validasi_ppk',
        'pdf_ppspm',
        'validasi_ppspm',
        'tgl_validasi_ppspm',
        'pdf_sp2d',
        'validasi_sp2d',
        'tgl_validasi_sp2d',
    ];
}
