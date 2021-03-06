<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GPNuocMat;

class LuuLuongTheoMucDichSD extends Model
{
    public $table = "nuocmat__luuluongtheomdsd";

    public function gp_nuoc_mat()
    {
        return $this->belongsTo(GPNuocMat::class);
    }
}
