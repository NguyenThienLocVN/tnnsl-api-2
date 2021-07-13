<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GPKTNuocDuoiDat;

class NuocDuoiDatGieng extends Model
{
    use HasFactory;
    public $table = "ktnuocduoidat__gieng";
    public $timestamps = false;

    protected $fillable = [
        'idgiayphep',
        'sohieu' ,
        'x',
        'y',
        'luuluongkhaithac',
        'chedo_ktsd',
        'chieusau_doanthunuoctu',
        'chieusau_doanthunuocden',
        'chieusau_mucnuoctinh',
        'chieusau_mucnuocdong_max',
        'tangchuanuoc',
];

    public function gp_ktnuocduoidat()
    {
        return $this->belongsTo(GPKTNuocDuoiDat::class);
    }
}
