<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\GPKTNuocDuoiDat;

class TaiLieuKTNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "ktnuocduoidat__tailieu";
    public $timestamps = false;

    protected $fillable = [
        'idgiayphep',
        'tailieu_nam',
        'tailieu_loaigiayphep',
        'tailieu_giayphep',
        'tailieu_donxincapphep',
        'tailieu_sodokhuvucvitricongtrinh',
        'tailieu_sodokhuvucvitricongtrinhkhaithac',
        'tailieu_baocaoketquathamdo',
        'tailieu_baocaohientrangkhaithac',
        'tailieu_ketqua_ptcln',
        'tailieu_vanban_yccd',
        'tailieu_giaytokhac',
    ];

    public function gp_ktnuocduoidat()
    {
        return $this->belongsTo(GPKTNuocDuoiDat::class);
    }
}
