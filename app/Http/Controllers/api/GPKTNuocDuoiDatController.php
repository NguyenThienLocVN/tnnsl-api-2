<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GPKTNuocDuoiDat;
use App\Models\NuocDuoiDatGieng;
use App\Models\TaiLieuKTNuocDuoiDat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $roleAdmin = GPKTNuocDuoiDat::whereIn('status', [0,2,3])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('created_at', 'ASC')->paginate(10);
        $roleUser = GPKTNuocDuoiDat::where('user_id', $user_id)->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('created_at', 'ASC')->paginate(10);
        return[
            'role_admin' => $roleAdmin,
            'role_user' => $roleUser,
        ];
    }

    public function filterLicense($status)
    {
        $currentDate = Carbon::now();

        $all = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->get();

        $chuaPheDuyet = GPKTNuocDuoiDat::where('status', '0')->get();

        $conHieuLuc = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get();
        $tongConHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->count();

        $sapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get();

        $hetHieuLuc = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get();
        $demHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->count();

        if($status === "all"){
            return $all;
        }elseif($status === "conhieuluc"){
            return $conHieuLuc;
        }elseif($status === "chuapheduyet"){
            return $chuaPheDuyet;
        }elseif($status === "hethieuluc"){
            return $hetHieuLuc;
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
                        'detailContent' => "<div> <h5 class='card-title fw-bold font-13'>".$item->hang_muc_ct[0]->sohieu.' - '.$item->congtrinh_ten."</h5> <table class='table table-striped table-hover mb-2'> <tbody> <tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ X</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->x."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ Y</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->y."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Địa điểm</td><td class='col-8 py-1'>".$item->congtrinh_diadiem."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Số GP</td><td class='col-8 py-1'>".$item->gp_sogiayphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Ngày cấp</td><td class='col-8 py-1'>".$item->gp_thoigiancapphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1 font-11'>Cấp thẩm quyền</td><td class='col-8 py-1'>".$item->gp_donvi_thamquyen."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Chủ giấy phép</td><td class='col-8 py-1'>".$item->chugiayphep_ten."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Q <sub>xả TT</sub> thực tế</td><td class='col-8 py-1'></td></tr></tbody> </table> <Link to={'/quan-ly-cap-phep/nuoc-duoi-dat/khai-thac/xem-thong-tin-chung/'+$item->id} class='card-link d-block text-center'>Chi tiết công trình</Link></div>"
                    ],
                    'id' => $item->id
                ]);
        }
        $infoJson = json_encode($infoArray, JSON_UNESCAPED_UNICODE);
        return $infoJson;
    }
    public function createLicense(Request $request)
    {
        $messages = [
            'chugiayphep_ten.required' => 'Vui lòng nhập tên chủ giấy phép', 
            'gp_sogiayphep.required' => 'Vui lòng nhập số giấy phép', 
            'chugiayphep_diachi.required' => 'Vui lòng nhập địa chỉ', 
            'chugiayphep_phone.required' => 'Vui lòng nhập số điện thoại',
            'chugiayphep_email.required' => 'Vui lòng nhập email', 
            'congtrinh_diachi.required' => 'Vui lòng nhập địa chỉ công trình', 
            'mucdich_ktsd.required' => 'Vui lòng nhập mục đích khai thác sử dụng', 
            'tangchuanuoc_license.required' => 'Vui lòng nhập thông tin nội dung tầng chứa nước khai thác', 
            'tangchuanuoc_gieng.required' => 'Vui lòng nhập thông tin tầng chứa nước khai thác', 
            'sogieng_quantrac.required' => 'Vui lòng nhập số lượng giếng quan trắc', 
            'tongluuluong_ktsd_max.required' => 'Vui lòng nhập số liệu tổng lưu lượng', 
            'gp_thoigiancapphep.required' => 'Vui lòng nhập thời gian cấp phép', 
            'sohieu.required' => 'Vui lòng nhập số hiệu giếng', 
            'x.required' => 'Vui lòng nhập tọa độ x', 
            'y.required' => 'Vui lòng nhập tọa độ y', 
            'luuluongkhaithac.required' => 'Vui lòng nhập số liệu lưu lượng khai thác', 
            'chedo_ktsd.required' => 'Vui lòng nhập chế độ khai thác', 
            'chieusau_doanthunuoctu.required' => 'Vui lòng nhập số liệu đoạn thu nước từ', 
            'chieusau_doanthunuocden.required' => 'Vui lòng nhập số liệu đoạn thu nước đến', 
            'chieusau_mucnuoctinh.required' => 'Vui lòng nhập số liệu chiều sâu mực nước tĩnh', 
            'chieusau_mucnuocdong_max.required' => 'Vui lòng nhập số liệu chiều sâu mực nươc động lớn nhất',
        ];

        $validator = Validator::make($request->all(), [
            'chugiayphep_ten' => 'required', 
            'gp_sogiayphep' => 'required', 
            'chugiayphep_diachi' => 'required', 
            'chugiayphep_phone' => 'required', 
            'chugiayphep_email' => 'required', 
            'congtrinh_diachi' => 'required', 
            'mucdich_ktsd' => 'required', 
            'tangchuanuoc_license' => 'required', 
            'tangchuanuoc_gieng' => 'required', 
            'sogieng_quantrac' => 'required', 
            'tongluuluong_ktsd_max' => 'required', 
            'gp_thoigiancapphep' => 'required', 
            'sohieu' => 'required', 
            'x' => 'required', 
            'y' => 'required', 
            'luuluongkhaithac' => 'required', 
            'chedo_ktsd' => 'required', 
            'chieusau_doanthunuoctu' => 'required', 
            'chieusau_doanthunuocden' => 'required', 
            'chieusau_mucnuoctinh' => 'required', 
            'chieusau_mucnuocdong_max' => 'required',
        ], $messages);
   
        if($validator->fails()){
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['error_message' => $msg], 400);       
        }else{
            $license = new GPKTNuocDuoiDat($request->all());
            $license->tangchuanuoc = $request->tangchuanuoc_license;
            $license->save();
            $gieng = new NuocDuoiDatGieng($request->all()); 
            $gieng->idgiayphep = $license->id;
            $gieng->tangchuanuoc = $request->tangchuanuoc_gieng;
            $gieng->save();
            $tailieu = new TaiLieuKTNuocDuoiDat($request->all()); 
            $tailieu->idgiayphep = $license->id;
            $tailieu->save();
            return response()->json(['success_message' => 'Xin cấp mới giấy phép thành công, chờ phê duyệt !' ]);
        }
    }
    public function updateStatus(Request $request, $id_gp)
    {
        $statusLicense = GPKTNuocDuoiDat::find($id_gp);
        $statusLicense->status = $request->status;
        $statusLicense->save();
        return response()->json(['success_message' => 'Cập nhật trạng thái giấy phép thành công !' ]);
    }
}
