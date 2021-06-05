<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiLieu extends Model
{
    use HasFactory;
    public $table = "tai_lieu";

    public function gp_nuoc_mat()
    {
        return $this->belongsTo(GPNuocMat::class);
    }
}
