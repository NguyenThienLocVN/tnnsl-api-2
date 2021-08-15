<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ToaDoCTThamDoNuocDuoiDat;
use App\Models\TaiLieuTDNuocDuoiDat;
use Carbon\Carbon;

class GPTDNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "tdnuocduoidat__gp";
    
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

    protected $appends = ['hieulucgiayphep'];

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

    public function toado_congtrinh()
    {
        return $this->hasMany(ToaDoCTThamDoNuocDuoiDat::class, 'idgiayphep', 'id');
    }

    public function tailieu_thamdo()
    {
        return $this->hasMany(TaiLieuTDNuocDuoiDat::class, 'idgiayphep', 'id');
    }
}

?>
