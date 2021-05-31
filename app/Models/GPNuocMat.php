<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HangMucCongTrinh;
use App\Models\LuuLuongTheoMucDichSD;

class GPNuocMat extends Model
{
    use HasFactory;
    public $table = "gp_nuoc_mat";

    public function hang_muc_ct()
    {
        return $this->hasMany(HangMucCongTrinh::class, 'id_gp', 'id');
    }

    public function luu_luong_theo_muc_dich_sd()
    {
        return $this->hasMany(LuuLuongTheoMucDichSD::class, 'id_gp', 'id');
    }
}
