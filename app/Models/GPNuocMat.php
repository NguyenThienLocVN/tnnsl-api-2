<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HangMucCongTrinh;
use App\Models\LuuLuongTheoMucDichSD;
use App\Models\TaiLieu;

class GPNuocMat extends Model
{
    use HasFactory;
    public $table = "gp_nuocmat";
    protected $appends = ['loaigiayphep'];

    public function hang_muc_ct()
    {
        return $this->hasMany(HangMucCongTrinh::class, 'idgiayphep', 'id');
    }

    public function luu_luong_theo_muc_dich_sd()
    {
        return $this->hasMany(LuuLuongTheoMucDichSD::class, 'idgiayphep', 'id');
    }

    public function tai_lieu()
    {
        return $this->hasMany(TaiLieu::class, 'idgiayphep', 'id');
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

    public function getMainCategoryForHydroelectric()
    {
        if($this->loai_ct == 'thuy-dien')
        {
            return $this->hang_muc_ct()->where('toa_do_chinh', 1);
        }
    }
}
