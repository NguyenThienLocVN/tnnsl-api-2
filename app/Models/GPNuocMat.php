<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NuocMatHangMuc;
use App\Models\LuuLuongTheoMucDichSD;
use App\Models\TaiLieu;
use Carbon\Carbon;

class GPNuocMat extends Model
{
    use HasFactory;
    public $table = "nuocmat__gp";
    protected $appends = ['loaigiayphep','hieulucgiayphep'];

    public function hang_muc_ct()
    {
        return $this->hasMany(NuocMatHangMuc::class, 'idgiayphep', 'id');
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
        if($this->gp_loaigiayphep == "cap-moi"){
            return "Cấp mới";
        }else if($this->gp_loaigiayphep == "cap-lai"){
            return "Cấp lại";
        }else if($this->gp_loaigiayphep == "thu-hoi"){
            return "Thu hồi";
        }else{
            return "";
        }
    }

    public function getHieulucgiayphepAttribute()
    {
        $currentDate = Carbon::now();

        $licenseDate = Carbon::parse($this->gp_ngayhethan);
        $dateSapHetHan = Carbon::now()->addDays(60);

        if($this->status == 0 || $this->status == '0'){
            return 'chuaduocduyet';
        }else if($currentDate < $licenseDate){
            if($licenseDate < $dateSapHetHan && $licenseDate == $currentDate){
                return 'saphethieuluc';
            }else{
                return 'conhieuluc';
            }
        }else if($currentDate > $licenseDate){
            return 'hethieuluc';
        }
    }
}
