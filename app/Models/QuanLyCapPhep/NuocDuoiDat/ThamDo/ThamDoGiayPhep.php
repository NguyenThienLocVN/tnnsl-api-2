<?php

namespace App\Models\QuanlyCapPhep\NuocDuoiDat\ThamDo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThamDoGiayPhep extends Model
{
    use HasFactory;
    public $table = "nuocduoidat__thamdo__giayphep";
    
    protected $fillable = [
        "id",
        "id_congtrinh",
        "id_chugiayphep",
        "gp_tengiayphep",
        "gp_sogiayphep",
        "gp_ngaycap",
        "gp_thoigianhanhnghe",
        "gp_ngayhethan",
        "chugiayphep_ten",
        "chugiayphep_diachi",
        "chugiayphep_sogiaydkkd",
        "chugiayphep_phone",
        "chugiayphep_fax",
        "chugiayphep_email",
        "gp_sogiayphepcu",
        "gp_loaigiayphep",
        "quymo_thamdo",
        "tangchuanuoc",
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

    // public function toado_congtrinh()
    // {
    //     return $this->hasMany(ToaDoCTThamDoNuocDuoiDat::class, 'idgiayphep', 'id');
    // }

    // public function tailieu_thamdo()
    // {
    //     return $this->hasMany(TaiLieuTDNuocDuoiDat::class, 'idgiayphep', 'id');
    // }
}
