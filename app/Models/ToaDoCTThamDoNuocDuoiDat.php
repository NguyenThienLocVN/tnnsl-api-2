<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToaDoCTThamDoNuocDuoiDat extends Model
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

    public function gp_tdnuocduoidat()
    {
        return $this->belongsTo(GPKTNuocDuoiDat::class);
    }
}
