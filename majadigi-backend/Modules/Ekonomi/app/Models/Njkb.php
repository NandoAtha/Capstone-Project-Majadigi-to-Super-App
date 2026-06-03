<?php

namespace Modules\Ekonomi\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Njkb extends Model
{
    use HasFactory;

    protected $table = 'njkbs';

    protected $fillable = [
        'jenis_kendaraan',
        'merk_kendaraan',
        'tahun_pembuatan',
        'model_tipe_spesifik',
        'cc_kendaraan',
        'nilai_jual',
        'tarif_plat_hitam_persen',
        'tarif_plat_hitam_progresif_persen',
        'tarif_plat_merah_persen',
        'tarif_plat_kuning_persen',
        'tarif_bbn_1_persen',
        'tarif_bbn_2_persen',
        'pnbp_penerbitan_bpkb',
        'pnbp_penerbitan_stnk',
        'pnbp_penerbitan_tnkb'
    ];

    protected $casts = [
        'tahun_pembuatan' => 'integer',
        'cc_kendaraan' => 'integer',
        'nilai_jual' => 'float',
        'tarif_plat_hitam_persen' => 'float',
        'tarif_plat_hitam_progresif_persen' => 'float',
        'tarif_plat_merah_persen' => 'float',
        'tarif_plat_kuning_persen' => 'float',
        'tarif_bbn_1_persen' => 'float',
        'tarif_bbn_2_persen' => 'float',
        'pnbp_penerbitan_bpkb' => 'float',
        'pnbp_penerbitan_stnk' => 'float',
        'pnbp_penerbitan_tnkb' => 'float',
    ];
}