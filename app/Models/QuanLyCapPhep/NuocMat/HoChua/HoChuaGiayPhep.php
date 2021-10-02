<?php

namespace App\Models\QuanlyCapPhep\NuocMat\HoChua;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoChuaGiayPhep extends Model
{
    use HasFactory;
     public $table = "nuocmat__hochua__giayphep";

    protected $fillable = [
        "id",
        "id_congtrinh",
        "id_chugiayphep",
        "gp_tengiayphep",
        "gp_sogiayphep",
        "gp_ngaycap",
        "gp_thoigiancapphep",
        "gp_ngayhethan",
        "chugiayphep_ten",
        "chugiayphep_diachi",
        "chugiayphep_sogiaydkkd",
        "chugiayphep_phone",
        "chugiayphep_fax",
        "chugiayphep_email",
        "gp_sogiayphepcu",
        "gp_loaigiayphep",
        "congsuat_lapmay",
        "luuluonglonnhat_quahochua",
        "luuluong_xadongchay_toithieu",
        "mucnuocdang_binhthuong",
        "mucnuoc_chet",
        "mucnuoccaonhat_truoclu",
        "mucnuoc_donlu",
        "dungtich_huuich",
        "dungtich_toanbo",
        "nguonnuoc_ktsd",
        "vitri_laynuoc",
        "thuocsong",
        "thuocluuvucsong",
        "chedo_ktsd",
        "phuongthuc_kt",
        "loaihinh_congtrinh_ktsd",
        "mucdich_ktsd",
        "luuluongnuoc_ktsd",
        "thoigian_batdau_vanhanh",
        "coquan_capphep",
        "donvi_thamdinh",
        "donvi_thamquyen",
        "nguoiky",
        "chucvu_nguoiky",
        "ghichu",
        "camket_dungsuthat",
        "camket_chaphanhdungquydinh",
        "camket_daguihoso",
        "user_created",
        "created_at",
        "ip_created",
        "user_updated",
        "updated_at",
        "ip_updated",
        "status",
    ];

    // protected $appends = ['loaigiayphep','hieulucgiayphep'];

    // public function hang_muc_ct()
    // {
    //     return $this->hasMany(NuocMatHangMuc::class, 'idgiayphep', 'id');
    // }

    // public function luu_luong_theo_muc_dich_sd()
    // {
    //     return $this->hasMany(LuuLuongTheoMucDichSD::class, 'idgiayphep', 'id');
    // }

    // public function tai_lieu()
    // {
    //     return $this->hasMany(TaiLieuNuocMat::class, 'idgiayphep', 'id');
    // }

    // public function getLoaigiayphepAttribute()
    // {
    //     if($this->gp_loaigiayphep == "cap-moi"){
    //         return "Cấp mới";
    //     }else if($this->gp_loaigiayphep == "cap-lai"){
    //         return "Cấp lại";
    //     }else if($this->gp_loaigiayphep == "thu-hoi"){
    //         return "Thu hồi";
    //     }else{
    //         return "";
    //     }
    // }

    // public function getHieulucgiayphepAttribute()
    // {
    //     $currentDate = Carbon::now();

    //     $licenseDate = $this->gp_ngayhethan;
    //     $dateSapHetHan = $this->gp_ngayhethan < Carbon::now()->addDays(90);

    //     if($this->status == 0 || $this->status == '0'){
    //         return 'chuaduocduyet';
    //     }
    //     if($currentDate > $licenseDate){
    //         if($licenseDate == '0000-00-00' || null){
    //             return 'conhieuluc';
    //         }
    //         else{
    //             return 'hethieuluc';
    //         }
    //     }else{
    //         if($dateSapHetHan){
    //             return 'saphethieuluc';
    //         }else{
    //             return 'conhieuluc';
    //         }
    //     }
    // }
}
