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
    protected $appends = ['loaigiayphep'];

    public function hang_muc_ct()
    {
        return $this->hasMany(HangMucCongTrinh::class, 'id_gp', 'id');
    }

    public function luu_luong_theo_muc_dich_sd()
    {
        return $this->hasMany(LuuLuongTheoMucDichSD::class, 'id_gp', 'id');
    }

    public function getLoaigiayphepAttribute()
    {
        if($this->loai_gp == "cap-moi"){
            return "Cấp mới";
        }else if($this->loai_ct == "cap-lai"){
            return "Cấp lại";
        }else if($this->loai_ct == "thu-hoi"){
            return "Thu hồi";
        }else{
            return "";
        }
    }
}
