<?php

namespace App\Http\Controllers\api\HeThongQuanTrac;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeThongQuanTrac\ToaDoCongTrinh;

class HeThongQuanTracController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function filterLocation($locationType){
        if($locationType == 'all')
        {
            $data = ToaDoCongTrinh::all();
        }
        else
        {
            $data = ToaDoCongTrinh::where('location_type', $locationType)->get();
        }
        

        return $data;
    }
}
