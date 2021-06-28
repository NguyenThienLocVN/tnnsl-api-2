<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\GPKTNuocDuoiDat;

class TaiLieuKTNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "tailieu_ktnuocduoidat";

    public function gp_ktnuocduoidat()
    {
        return $this->belongsTo(GPKTNuocDuoiDat::class);
    }
}
