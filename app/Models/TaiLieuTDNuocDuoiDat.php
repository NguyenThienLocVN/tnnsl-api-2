<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GPTDNuocDuoiDat;

class TaiLieuTDNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "tdnuocduoidat__tailieu";
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

    public function gp_tdnuocduoidat()
    {
        return $this->belongsTo(GPTDNuocDuoiDat::class);
    }
}
