<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\GPNuocMat;

class TaiLieuNuocMat extends Model
{
    use HasFactory;
    public $table = "tailieu_nuocmat";

    public function gp_nuoc_mat()
    {
        return $this->belongsTo(GPNuocMat::class);
    }
}
