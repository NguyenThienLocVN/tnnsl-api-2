<?php

namespace App\Models\QuanLyCapPhep\NuocDuoiDat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuanLyCapPhep\NuocDuoiDat\GPTDNuocDuoiDat;

class NuocDuoiDatGieng extends Model
{
    use HasFactory;
    public $table = "ktnuocduoidat__gieng";
    public $timestamps = false;

    protected $fillable = [
        'idgiayphep',
        'stt_diemgoc' ,
        'congtrinh_toado_x',
        'congtrinh_toado_y',
        'latitude',
        'longitude',
    ];

    public function gp_ktnuocduoidat()
    {
        return $this->belongsTo(GPTDNuocDuoiDat::class);
    }
}
