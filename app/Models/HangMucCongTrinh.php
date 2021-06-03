<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GPNuocMat;

class HangMucCongTrinh extends Model
{
    use HasFactory;
    public $table = "hang_muc_cong_trinh";

    public function gp_nuoc_mat()
    {
        return $this->belongsTo(GPNuocMat::class);
    }
}
