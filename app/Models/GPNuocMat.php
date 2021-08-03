<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NuocMatHangMuc;
use App\Models\LuuLuongTheoMucDichSD;
use App\Models\TaiLieuNuocMat;
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
        return $this->hasMany(TaiLieuNuocMat::class, 'idgiayphep', 'id');
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

        $licenseDate = $this->gp_ngayhethan;
        $dateSapHetHan = $this->gp_ngayhethan < Carbon::now()->addDays(90);

        if($this->status == 0 || $this->status == '0'){
            return 'chuaduocduyet';
        }
        if($currentDate > $licenseDate){
            if($licenseDate == '0000-00-00' || null){
                return 'conhieuluc';
            }
            else{
                return 'hethieuluc';
            }
        }else{
            if($dateSapHetHan){
                return 'saphethieuluc';
            }else{
                return 'conhieuluc';
            }
        }
    }
}