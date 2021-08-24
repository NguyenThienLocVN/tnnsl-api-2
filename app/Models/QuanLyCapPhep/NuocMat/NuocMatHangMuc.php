<?php

namespace App\Models\QuanLyCapPhep\NuocMat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NuocMatHangMuc extends Model
{
    use HasFactory;
    public $table = "nuocmat__hangmuc";

    protected $fillable = [
        'idgiayphep',
        'tenhangmuc',
        'x',
        'y'
    ];

    public $timestamps = false;

    public function gp_nuoc_mat()
    {
        return $this->belongsTo(GPNuocMat::class);
    }
}
