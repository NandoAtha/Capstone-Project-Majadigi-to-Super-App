<?php

namespace Modules\Ekonomi\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'nomor_polisi',
        'nomor_rangka_lima_digit',
        'is_aktif',
        'warna_kendaraan',
        'model_kendaraan',
        'tipe_kendaraan',
        'tahun_pembuatan',
        'tanggal_jatuh_tempo_pajak',
        'tanggal_jatuh_tempo_stnk',
        'opsen_pkb',
        'pkb_dasar',
        'pkb_progresif',
        'swdkllj',
        'parkir_berlangganan',
        'biaya_pengesahan_stnk',
        'total_denda',
        'biaya_cetak_stnk',
        'biaya_cetak_tnkb'
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
        'tanggal_jatuh_tempo_pajak' => 'date',
        'tanggal_jatuh_tempo_stnk' => 'date',
        'pkb_dasar' => 'float',
        'pkb_progresif' => 'float',
        'swdkllj' => 'float',
        'parkir_berlangganan' => 'float',
        'biaya_pengesahan_stnk' => 'float',
        'total_denda' => 'float',
        'biaya_cetak_stnk' => 'float',
        'biaya_cetak_tnkb' => 'float',
    ];

    // Append custom field ke response JSON API
    protected $appends = ['status_stnk_alert'];

    /**
     * Otomatis membuat teks instruksi dinamis jika masa berlaku STNK habis
     */
    public function getStatusStnkAlertAttribute()
    {
        if (Carbon::parse($this->tanggal_jatuh_tempo_stnk)->isPast()) {
            return [
                'is_expired' => true,
                'alert_level' => 'danger',
                'pesan' => 'Masa berlaku STNK/Plat 5 Tahunan Anda telah habis! Harap segera melakukan pemeriksaan fisik kendaraan dan perpanjangan di Kantor Bersama Samsat terdekat.'
            ];
        }

        return [
            'is_expired' => false,
            'alert_level' => 'success',
            'pesan' => 'Masa berlaku STNK aktif.'
        ];
    }
}