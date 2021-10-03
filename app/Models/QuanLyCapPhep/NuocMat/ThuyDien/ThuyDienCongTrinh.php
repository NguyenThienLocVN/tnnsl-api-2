<?php

namespace App\Models\QuanlyCapPhep\NuocMat\ThuyDien;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\QuanlyCapPhep\NuocMat\ThuyDien\ThuyDienGiayPhep;

class ThuyDienCongTrinh extends Model
{
    use HasFactory;
    public $table = 'nuocmat__thuydien__congtrinh';

    protected $fillable = [
		'id',
		'congtrinh_ten',
		'congtrinh_diadiem',
		'matinh',
		'mahuyen',
		'maxa',
		'congtrinh_hientrang',
		'user_created',
		'time_created',
		'ip_created',
		'user_updated',
		'time_updated',
		`ip_updated`,
    ];

	public function giay_phep()
    {
        return $this->hasMany(ThuyDienGiayPhep::class, 'id_congtrinh', 'id');
    }
}
