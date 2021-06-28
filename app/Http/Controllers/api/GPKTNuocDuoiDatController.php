<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GPKTNuocDuoiDat;
use App\Models\User;
use Carbon\Carbon;

class GPKTNuocDuoiDatController extends Controller
{
    public function license()
    {
        $license = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->get();
        return $license;
    }
    public function countLicense()
    {
        $currentDate = Carbon::now();

        $allgp_ktsdnuocduoidat = GPKTNuocDuoiDat::all()->count();

        $gp_ktsdnuocduoidatGPDaCap = GPKTNuocDuoiDat::where('status', '1')->get()->count();

        $gp_ktsdnuocduoidatConHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_ktsdnuocduoidatSapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();

        $gp_ktsdnuocduoidatHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();


        return [
        'gp_ktsdnuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_ktsdnuocduoidat,
                'giay_phep_da_cap' => $gp_ktsdnuocduoidatGPDaCap,
                'chua_phe_duyet' => $allgp_ktsdnuocduoidat - $gp_ktsdnuocduoidatGPDaCap,
                'con_hieu_luc' => $gp_ktsdnuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_ktsdnuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_ktsdnuocduoidatHetHieuLuc,
            ],
        ];
    }
    public function singleLicense($id_gp)
    {
        $LicenseInfo = GPKTNuocDuoiDat::where('id', $id_gp)->with('hang_muc_ct')->get();
        return $LicenseInfo;
    }
    public function NewLicenseManagement($user_id)
    {
        $roleAdmin = GPKTNuocDuoiDat::whereIn('status', [0,2,3])->paginate(10);
        $roleUser = GPKTNuocDuoiDat::where('user_id', $user_id)->paginate(10);
        return[
            'role_admin' => $roleAdmin,
            'role_user' => $roleUser,
        ];
    }

    public function filterLicense($status)
    {
        $currentDate = Carbon::now();

        $all = GPKTNuocDuoiDat::all();

        $chuaPheDuyet = GPKTNuocDuoiDat::where('status', '0')->get();

        $conHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get();

        $sapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get();

        $hetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->paginate(10);
        $demHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->count();

        if($status === "all"){
            return $all;
        }elseif($status === "conhieuluc"){
            return $conHieuLuc;
        }elseif($status === "chuapheduyet"){
            return $chuaPheDuyet;
        }elseif($status === "hethieuluc"){
            return [
                'hethieuluc' => $hetHieuLuc,
                'tong_hethieuluc' => $demHetHieuLuc
            ];
        }elseif($status === "saphethieuluc"){
            return $sapHetHieuLuc;
        }
    }
    
    // Thong tin cong trinh hien thi tren ban do
    public function contructionInfoForMap()
    {
        $licenses = GPKTNuocDuoiDat::with('hang_muc_ct')->paginate(10);

        $infoArray = ['type' => 'FeatureCollection',
                        'features' =>[]
                        ];

        foreach($licenses as $item){
            array_push($infoArray['features'], 
                [
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [$item->hang_muc_ct[0]->latitude, $item->hang_muc_ct[0]->longitude]
                    ],
                    'type' => 'Feature',
                    'properties' => [
                        'hoverContent' => "<b>$item->congtrinh_ten</b>",
                        'detailContent' => "<div> <h5 class='card-title fw-bold font-13'>".$item->hang_muc_ct[0]->sohieu.' - '.$item->congtrinh_ten."</h5> <table class='table table-striped table-hover mb-2'> <tbody> <tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ X</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->x."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ Y</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->y."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Địa điểm</td><td class='col-8 py-1'>".$item->congtrinh_diadiem."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Số GP</td><td class='col-8 py-1'>".$item->gp_sogiayphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Ngày cấp</td><td class='col-8 py-1'>".$item->gp_thoigiancapphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1 font-11'>Cấp thẩm quyền</td><td class='col-8 py-1'>".$item->gp_donvi_thamquyen."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Q <sub>xả TT</sub> gp</td><td class='col-8 py-1'>".$item->luuluong_xadongchay_toithieu." m<sup>3</sup>/s</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Q <sub>xả TT</sub> thực tế</td><td class='col-8 py-1'></td></tr></tbody> </table> <Link to={'/quan-ly-cap-phep/nuoc-duoi-dat/khai-thac/xem-thong-tin-chung/'+$item->id} class='card-link d-block text-center'>Chi tiết công trình</Link></div>"
                    ],
                    'id' => $item->id
                ]);
        }
        $infoJson = json_encode($infoArray, JSON_UNESCAPED_UNICODE);
        return $infoJson;
    }
}
