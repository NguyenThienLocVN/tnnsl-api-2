<?php

namespace App\Models\QuanLyCapPhep\NuocMat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\QuanLyCapPhep\NuocMat\GPNuocMat;

class TaiLieuNuocMat extends Model
{
    use HasFactory;
    public $table = "nuocmat__tailieu";

    protected $fillable = [
        'idgiayphep',
        'tailieu_loaigiayphep',
        'tailieu_nam',
        'tailieu_giayphep',
        'tailieu_donxincapphep',
        'tailieu_baocaodean_ktsd',
        'tailieu_ketqua_ptcln',
        'tailieu_baocaohientrangkhaithac',
        'tailieu_vanban_yccd',
        'tailieu_giaytokhac',
        'tailieu_sodovitrikhuvuc_congtrinh_khaithac',
        'tailieu_quyetdinhpheduyetlan1',
        'tailieu_quyetdinhpheduyetlan2'
    ];

    public $timestamps = false;

    public function gp_nuoc_mat()
    {
        return $this->belongsTo(GPNuocMat::class);
    }
}
