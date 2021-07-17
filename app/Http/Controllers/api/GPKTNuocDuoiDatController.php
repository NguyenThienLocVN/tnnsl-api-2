<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GPKTNuocDuoiDat;
use App\Models\NuocDuoiDatGieng;
use App\Models\TaiLieuKTNuocDuoiDat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GPKTNuocDuoiDatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

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
        $LicenseInfo = GPKTNuocDuoiDat::where('id', $id_gp)->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->get();
        return $LicenseInfo;
    }
    public function NewLicenseManagement($user_id, $status)
    {
        $role = User::where('id',$user_id)->get()->pluck('role');

        $currentDate = Carbon::now();
        // role admin

        $adminAll = GPKTNuocDuoiDat::whereIn('status', [0,1,2,3])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $adminNopHoSo = GPKTNuocDuoiDat::whereIn('status', [0])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $adminDangLayYKienThamDinh = GPKTNuocDuoiDat::whereIn('status', [2])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $adminHoanThanhHoSoCapPhep = GPKTNuocDuoiDat::whereIn('status', [3])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $adminDaDuocCapPhep = GPKTNuocDuoiDat::whereIn('status', [1])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        // role user

        $userAll = GPKTNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [0,1,2,3])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $userNopHoSo = GPKTNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [0])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $userDangLayYKienThamDinh = GPKTNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [2])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $userHoanThanhHoSoCapPhep = GPKTNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [3])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        $userDaDuocCapPhep = GPKTNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [1])->with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->orderBy('id', 'DESC')->get();

        if($role[0] == "admin"){
            if($status == "all"){
                return $adminAll;
            }elseif($status == "2"){
                return $adminDangLayYKienThamDinh;
            }elseif($status == "0"){
                return $adminNopHoSo;
            }elseif($status == "3"){
                return $adminHoanThanhHoSoCapPhep;
            }elseif($status == "1"){
                return $adminDaDuocCapPhep;
            }
        }elseif($role[0] == "user"){
            if($status == "all"){
                return $userAll;
            }elseif($status == "2"){
                return $userDangLayYKienThamDinh;
            }elseif($status == "0"){
                return $userNopHoSo;
            }elseif($status == "3"){
                return $userHoanThanhHoSoCapPhep;
            }elseif($status == "1"){
                return $userDaDuocCapPhep;
            }
        }
    }

    public function filterLicense($status)
    {
        $currentDate = Carbon::now();

        $all = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->get();

        $chuaPheDuyet = GPKTNuocDuoiDat::where('status', '0')->get();

        $conHieuLuc = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get();

        $sapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get();

        $hetHieuLuc = GPKTNuocDuoiDat::with('hang_muc_ct')->with('tai_lieu_nuoc_duoi_dat')->where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get();

        if($status == "all"){
            return $all;
        }elseif($status == "conhieuluc"){
            return $conHieuLuc;
        }elseif($status == "chuapheduyet"){
            return $chuaPheDuyet;
        }elseif($status == "hethieuluc"){
            return $hetHieuLuc;
        }elseif($status == "saphethieuluc"){
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
            if(count($item->hang_muc_ct) != 0){
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
        }
        $infoJson = json_encode($infoArray, JSON_UNESCAPED_UNICODE);
        return $infoJson;
    }

    public function createLicense(Request $request)
    {
        $messages = [
            'chugiayphep_ten.required' => 'Vui lòng nhập tên chủ giấy phép', 
            'chugiayphep_sogiaydangkykinhdoanh.required' => 'Vui lòng nhập số giấy đăng ký kinh doanh',
            'chugiayphep_diachi.required' => 'Vui lòng nhập địa chỉ', 
            'chugiayphep_phone.required' => 'Vui lòng nhập số điện thoại',
            'chugiayphep_phone.numeric' => 'Vui lòng nhập số điện thoại hợp lệ',
            'chugiayphep_email.required' => 'Vui lòng nhập email', 
            'chugiayphep_email.email' => 'Vui lòng nhập email hợp lệ',
            'congtrinh_ten.required' => 'Vui lòng nhập tên công trình', 
            'congtrinh_diadiem.required' => 'Vui lòng nhập địa chỉ công trình', 
            'mucdich_ktsd.required' => 'Vui lòng nhập mục đích khai thác sử dụng', 
            'sogieng_quantrac.required' => 'Vui lòng nhập số lượng giếng quan trắc', 
            'tongluuluong_ktsd_max.required' => 'Vui lòng nhập số liệu tổng lưu lượng', 
            'gp_thoigiancapphep.required' => 'Vui lòng nhập thời gian cấp phép',
        ];

        $validator = Validator::make($request->all(), [
            'chugiayphep_ten' => 'required', 
            'chugiayphep_sogiaydangkykinhdoanh' => 'required', 
            'chugiayphep_diachi' => 'required', 
            'chugiayphep_phone' => 'required|numeric', 
            'chugiayphep_email' => 'required|email',
            'congtrinh_ten' => 'required', 
            'congtrinh_diadiem' => 'required', 
            'mucdich_ktsd' => 'required', 
            'sogieng_quantrac' => 'required', 
            'tongluuluong_ktsd_max' => 'required', 
            'gp_thoigiancapphep' => 'required',
        ], $messages);
   
        if($validator->fails()){
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['message' => $msg], 400);       
        }else{
            
            $license = new GPKTNuocDuoiDat($request->all());
            $license->user_id = $request->user()->id;
            $license->camket_dungsuthat = $request->camket_dungsuthat == "true" ? 1 : 0;
            $license->camket_chaphanhdungquydinh = $request->camket_chaphanhdungquydinh == "true" ? 1 : 0;
            $license->camket_daguihoso = $request->camket_daguihoso == "true" ? 1 : 0;
            $license->status = 0;
            $license->save();


            $giengs = $request->giengs;
            foreach ($giengs as $key => $data) {
                NuocDuoiDatGieng::create([
                  'idgiayphep'   =>  $license->id,
                  'sohieu'       =>  $data['sohieu'],
                  'x'            =>  $data['x'],
                  'y'            =>  $data['y'],
                  'luuluongkhaithac' =>  $data['luuluongkhaithac'],
                  'chedo_ktsd'     =>  $data['chedo_ktsd'],
                  'chieusau_doanthunuoctu'     =>  $data['chieusau_doanthunuoctu'],
                  'chieusau_doanthunuocden'     =>  $data['chieusau_doanthunuocden'],
                  'chieusau_mucnuoctinh'     =>  $data['chieusau_mucnuoctinh'],
                  'chieusau_mucnuocdong_max' => $data['chieusau_mucnuocdong_max'],
                  'tangchuanuoc' => $data['tangchuanuoc']
                ]);
            }
            
            // Save uploaded files
            $destinationPath = 'uploads/2021/khai-thac-nuoc-duoi-dat/';
            $files = $request->file();
            foreach($files as $file)
            {
                $fileName = $license->id.'-'.$file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
            }

            $DonXinCapPhep = $request->file('tailieu_donxincapphep');
            $SoDoViTriCongTrinh = $request->file('tailieu_sodokhuvucvitricongtrinh');
            $SoDoViTriCongTrinhKhaiThac = $request->file('tailieu_sodokhuvucvitricongtrinhkhaithac');
            $BaoCaoHienTrangKhaiThac = $request->file('tailieu_baocaohientrangkhaithac');
            $VanBanYKienCongDong = $request->file('tailieu_vanban_yccd');
            $BaoCaoKetQuaThamDo = $request->file('tailieu_baocaoketquathamdo');
            $KetQuaPTCLN = $request->file('tailieu_ketqua_ptcln');
            $GiayToKhac = $request->file('tailieu_giaytokhac');

            $tailieu = new TaiLieuKTNuocDuoiDat($request->all()); 
            $tailieu->idgiayphep = $license->id;
            $tailieu->tailieu_nam = Carbon::now()->format('Y');
            $tailieu->tailieu_loaigiayphep = 'khai-thac-nuoc-duoi-dat';
            $tailieu->tailieu_donxincapphep = $license->id.'-'.$DonXinCapPhep->getClientOriginalName();
            $tailieu->tailieu_sodokhuvucvitricongtrinh = $license->id.'-'.$SoDoViTriCongTrinh->getClientOriginalName();
            $tailieu->tailieu_sodokhuvucvitricongtrinhkhaithac = $license->id.'-'.$SoDoViTriCongTrinhKhaiThac->getClientOriginalName();
            $tailieu->tailieu_baocaoketquathamdo = $license->id.'-'.$BaoCaoKetQuaThamDo->getClientOriginalName();
            $tailieu->tailieu_baocaohientrangkhaithac = $license->id.'-'.$BaoCaoHienTrangKhaiThac->getClientOriginalName();
            $tailieu->tailieu_ketqua_ptcln = $license->id.'-'.$KetQuaPTCLN->getClientOriginalName();
            $tailieu->tailieu_vanban_yccd = $license->id.'-'.$VanBanYKienCongDong->getClientOriginalName();
            $tailieu->tailieu_giaytokhac = $license->id.'-'.$GiayToKhac->getClientOriginalName();
            $tailieu->save();

            return response()->json(['success_message' => 'Xin cấp mới giấy phép thành công, chờ phê duyệt !' ]);
        }
    }

    public function destroyLicense($id_gp)
    {
        $destroyLicense = GPKTNuocDuoiDat::find($id_gp);
        $destroyLicense->delete();  
        return response()->json(['success_message' => 'Xóa giấy phép thành công !' ]);
    }
}
