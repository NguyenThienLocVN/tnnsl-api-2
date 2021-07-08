<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NuocDuoiDatGieng;
use App\Models\TaiLieuKTNuocDuoiDat;
use Carbon\Carbon;

class GPKTNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "gp_ktnuocduoidat";
    protected $appends = ['hieulucgiayphep'];
    protected $fillable = [
        'user_id',
        'gp_sogiayphep',
        'gp_tengiayphep ',
        'gp_thoigiancapphep',
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
        'chugiayphep_ten',
        'chugiayphep_diachi',
        'chugiayphep_sogiaydangkykinhdoanh',
        'chugiayphep_phone',
        'chugiayphep_fax',
        'chugiayphep_email',
        'congtrinh_ten',
        'congtrinh_ten',
        'congtrinh_diadiem',
        'congtrinh_ghichu',
        'mahuyen',
        'maxa',
        'tangchuanuoc',
        'tongluuluong_ktsd_max',
        'mucdich_ktsd',
        'sogieng_quantrac',
        'sodiemlo_khaithac',
        'somachlo_khaithac',
        'thuocluuvuc',
        'thuocluuvucsong',
        'loai_kinh_tuyen_truc',
        'muichieu',
        'thoigian_batdau_vanhanh',
        'sogieng_khaithac_duphong',
        'camket_dungsuthat',
        'camket_chaphanhdungquydinh',
        'camket_daguihoso',
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

    public function hang_muc_ct()
    {
        return $this->hasMany(NuocDuoiDatGieng::class, 'idgiayphep', 'id');
    }

    public function tai_lieu_nuoc_duoi_dat()
    {
        return $this->hasMany(TaiLieuKTNuocDuoiDat::class, 'idgiayphep', 'id');
    }
}
