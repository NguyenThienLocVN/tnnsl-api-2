<?php

namespace App\Models\QuanlyCapPhep\NuocDuoiDat\KhaiThac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhaiThacGiayPhep extends Model
{
    use HasFactory;
    public $table = "nuocduoidat__khaithac__giayphep";
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
        "tangchuanuoc",
        "tongluuluong_ktsd_max",
        "mucdich_ktsd",
        "sogieng_khaithac",
        "sodiemlo_khaithac",
        "somachlo_khaithac",
        "thoigian_batdau_vanhanh",
        "sogieng_khaithac_duphong",
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


    // protected $appends = ['hieulucgiayphep'];

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

    // public function hang_muc_ct()
    // {
    //     return $this->hasMany(NuocDuoiDatGieng::class, 'idgiayphep', 'id');
    // }

    // public function tai_lieu_nuoc_duoi_dat()
    // {
    //     return $this->hasMany(TaiLieuKTNuocDuoiDat::class, 'idgiayphep', 'id');
    // }
}
