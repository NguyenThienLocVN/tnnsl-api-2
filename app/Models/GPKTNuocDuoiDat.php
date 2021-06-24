<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NuocDuoiDatGieng;
use Carbon\Carbon;

class GPKTNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "gp_ktnuocduoidat";
    protected $appends = ['hieulucgiayphep'];

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
}
