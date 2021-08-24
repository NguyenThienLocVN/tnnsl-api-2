<?php

namespace App\Models\QuanLyCapPhep\NuocMat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class HoChua extends Model
{
    use HasFactory;
    public $table = "nuocmat__gphochua";

    protected $fillable = [
        'user_id',
        'gp_sogiayphep',
        'gp_tengiayphep',
        'gp_ngaycap',
        'chugiayphep_ten',
        'chugiayphep_diachi',
        'chugiayphep_sogiaydangkykinhdoanh',
        'chugiayphep_phone',
        'chugiayphep_fax',
        'chugiayphep_email',
        'gp_coquan_capphep',
        'gp_donvi_thamdinh',
        'gp_donvi_thamquyen',
        'gp_loaigiayphep',
        'gp_thoihangiayphep',
        'gp_nguoiky',
        'gp_chucvu_nguoiky',
        'gp_ngayky',
        'gp_ngaybatdau',
        'gp_ngayhethan',
        'gp_noinhan',
        'gp_ghichu',
        'congtrinh_ten',
        'congtrinh_kyhieu',
        'congtrinh_loaihinh_ktsd',
        'congtrinh_diadiem',
        'congtrinh_hientrang',
        'mahuyen',
        'maxa',
        'mucdich_ktsd',
        'nguonnuoc_ktsd',
        'vitri_laynuoc',
        'thuocsong',
        'thuocluuvucsong',
        'congsuat_lapmay',
        'luuluonglonnhat_quathuydien',
        'luuluong_xadongchay_toithieu',
        'dungtich_huuich',
        'dungtich_toanbo',
        'mucnuoc_chet',
        'mucnuocdang_binhthuong',
        'mucnuoccaonhat_truoclu',
        'mucnuoc_donlu',
        'che_do_kt',
        'luuluongnuoc_ktsd',
        'phuongthuc_kt',
        'thoigianbom_trungbinh',
        'congsuatbom',
        'thoigian_batdau_vanhanh',
        'congtrinh_ghichu',
        'camket_dungsuthat',
        'camket_chaphanhdungquydinh',
        'camket_daguihoso',
        'created_at',
        'updated_at',
        'status',
    ];

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
