<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GPKhoanNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "khoannuocduoidat__gp";
    protected $appends = ['hieulucgiayphep'];
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
        'gp_thoigiancapphep',
        'gp_nguoiky',
        'gp_chucvu_nguoiky',
        'gp_ngayky',
        'gp_ngaybatdau',
        'gp_ngayhethan',
        'gp_noinhan',
        'gp_ghichu',
        'congtrinh_ten',
        'congtrinh_kyhieu',
        'congtrinh_diadiem',
        'mahuyen',
        'maxa',
        'quymothamdo',
        'tangchuanuoc',
        'thoigian_batdau_vanhanh',
        'sogieng_khaithac_duphong',
        'congtrinh_ghichu',
        'camket_dungsuthat',
        'camket_chaphanhdungquydinh',
        'camket_daguihoso',
        'created_at',
        'updated_at',
        'status',
    ];

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

    // public function hang_muc_ct()
    // {
    //     return $this->hasMany(NuocDuoiDatGieng::class, 'idgiayphep', 'id');
    // }

    // public function tai_lieu_nuoc_duoi_dat()
    // {
    //     return $this->hasMany(TaiLieuKTNuocDuoiDat::class, 'idgiayphep', 'id');
    // }
}
