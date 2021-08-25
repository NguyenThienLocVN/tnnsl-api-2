<?php

namespace App\Models\QuanLyCapPhep\NuocDuoiDat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToaDoCTThamDoNuocDuoiDat extends Model
{
    use HasFactory;
    public $table = "tdnuocduoidat__toadocongtrinh";
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

    public function gp_tdnuocduoidat()
    {
        return $this->belongsTo(GPKTNuocDuoiDat::class);
    }
}