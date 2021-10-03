<?php

namespace App\Http\Controllers\api\QuanLyCapPhep\NuocMat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



// THUY DIEN
use App\Models\QuanLyCapPhep\NuocMat\ThuyDien\ThuyDienGiayPhep;

// HO CHUA
use App\Models\QuanLyCapPhep\NuocMat\HoChua;

// TRAM CAP NUOC
use App\Models\QuanLyCapPhep\NuocMat\TramCapNuoc;

// TRAM BOM
use App\Models\QuanLyCapPhep\NuocMat\TramBom;

// NHA MAY NUOC
use App\Models\QuanLyCapPhep\NuocMat\NhaMayNuoc;



use App\Models\QuanLyCapPhep\NuocMat\GPNuocMat;
use App\Models\QuanLyCapPhep\NuocMat\NuocMatHangMuc;
use App\Models\QuanLyCapPhep\NuocMat\TaiLieuNuocMat;



class GPNuocMatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // XOA GIAY PHEP
    public function destroyLicense($id_gp)
    {
        $destroyLicense = ThuyDien::find($id_gp);
        $destroyLicense->delete();  
        return response()->json(['success_message' => 'Xóa giấy phép thành công !' ]);
    }

    // TAO MOI GIAY PHEP
    public function createLicense(Request $request)
    {
        $messages = [
            'chugiayphep_ten.required' => 'Vui lòng nhập tên cá nhân / tổ chức đề nghị cấp phép', 
            'chugiayphep_diachi.required' => 'Vui lòng nhập địa chỉ', 
            'chugiayphep_phone.required' => 'Vui lòng nhập số điện thoại',
            'chugiayphep_phone.numeric' => 'Vui lòng nhập số điện thoại hợp lệ',
            'chugiayphep_email.required' => 'Vui lòng nhập email', 
            'chugiayphep_email.email' => 'Vui lòng nhập email hợp lệ',
            'congtrinh_ten.required' => 'Vui lòng nhập tên công trình',
            'congtrinh_diadiem.required' => 'Vui lòng nhập địa chỉ công trình',
            'phuongthuc_kt.required' => 'Vui lòng nhập phương thức khai thác',
            'congtrinh_hientrang.required' => 'Vui lòng nhập hiện trạng công trình',
            'congsuat_lapmay.required' => 'Vui lòng nhập công suất lắp máy',
            'congsuat_lapmay.numeric' => 'Vui lòng nhập công suất lắp máy hợp lệ',
            'luuluonglonnhat_quathuydien.required' => 'Vui lòng nhập lưu lượng lớn nhất qua nhà máy thủy điện',
            'luuluonglonnhat_quathuydien.regex' => 'Vui lòng nhập lưu lượng lớn nhất qua nhà máy thủy điện đúng định dạng số thập phân VD: 21.34',
            'mucnuocdang_binhthuong.required' => 'Vui lòng nhập mực nước dâng bình thường',
            'mucnuocdang_binhthuong.regex' => 'Vui lòng nhập mực nước dâng bình thường đúng định dạng số thập phân VD: 21.34',
            'mucnuoc_chet.required' => 'Vui lòng nhập mực nước chết',
            'mucnuoc_chet.regex' => 'Vui lòng nhập mực nước chết đúng định dạng số thập phân VD: 21.34',
            'mucnuoccaonhat_truoclu.required' => 'Vui lòng nhập mực nước cao nhất trước lũ',
            'mucnuoccaonhat_truoclu.regex' => 'Vui lòng nhập mực nước cao nhất trước lũ đúng định dạng số thập phân VD: 21.34',
            'mucnuoc_donlu.required' => 'Vui lòng nhập mực nước đón lũ',
            'mucnuoc_donlu.regex' => 'Vui lòng nhập mực nước đón lũ đúng định dạng số thập phân VD: 21.34',
            'dungtich_huuich.required' => 'Vui lòng nhập dung tích hữu ích',
            'dungtich_huuich.regex' => 'Vui lòng nhập dung tích hữu ích đúng định dạng số thập phân VD: 21.34',
            'dungtich_toanbo.required' => 'Vui lòng nhập dung tích toàn bộ',
            'dungtich_toanbo.regex' => 'Vui lòng nhập dung tích toàn bộ đúng định dạng số thập phân VD: 21.34',
            'luuluong_xadongchay_toithieu.required' => 'Vui lòng nhập lưu lượng xả dòng chảy tối thiểu',
            'luuluong_xadongchay_toithieu.regex' => 'Vui lòng nhập lưu lượng xả dòng chảy tối thiểu đúng định dạng số thập phân VD: 21.34',
            'nguonnuoc_ktsd.required' => 'Vui lòng nhập nguồn nước khai thác sử dụng',
            'vitri_laynuoc.required' => 'Vui lòng nhập vị trí lấy nước',
            'mucdich_ktsd.required' => 'Vui lòng nhập mục đích khai thác sử dụng',
            'luuluongnuoc_ktsd.required' => 'Vui lòng nhập lượng nước khai thác sử dụng',
            'luuluongnuoc_ktsd.regex' => 'Vui lòng nhập lượng nước khai thác sử dụng đúng định dạng số thập phân VD: 21.34',
            'che_do_kt.required' => 'Vui lòng nhập chế độ khai thác',
            'gp_thoihangiayphep.required' => 'Vui lòng nhập thời hạn giấy phép',
            'camket_dungsuthat.numeric' => 'Vui lòng chọn cam kết đúng sự thật',
            'camket_chaphanhdungquydinh.numeric' => 'Vui lòng chọn cam kết đúng quy định',
            'hangmuc.required' => 'Vui lòng nhập hạng mục công trình'
        ];

        $validator = Validator::make($request->all(), [
            'chugiayphep_ten' => 'required',  
            'chugiayphep_diachi' => 'required', 
            'chugiayphep_phone' => 'required|numeric', 
            'chugiayphep_email' => 'required|email',
            'congtrinh_ten' => 'required', 
            'congtrinh_diadiem' => 'required', 
            'phuongthuc_kt' => 'required',
            'congtrinh_hientrang' => 'required',
            'congsuat_lapmay' => 'required|numeric',
            'luuluonglonnhat_quathuydien' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuocdang_binhthuong' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuoc_chet' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuoccaonhat_truoclu' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuoc_donlu' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'dungtich_huuich' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'dungtich_toanbo' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'luuluong_xadongchay_toithieu' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'nguonnuoc_ktsd' => 'required',
            'vitri_laynuoc' => 'required',
            'mucdich_ktsd' => 'required', 
            'luuluongnuoc_ktsd' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'che_do_kt' => 'required',
            'gp_thoihangiayphep' => 'required',
            'camket_dungsuthat' => 'required',
            'camket_chaphanhdungquydinh' => 'required',
            'hangmuc' => 'required'
        ], $messages);
   
        if($validator->fails()){
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['error_message' => $msg], 400);       
        }else{
            $license = new ThuyDien($request->all());
            $license->user_id = $request->user()->id;
            $license->gp_loaigiayphep = 'cap-moi';
            $license->camket_dungsuthat = $request->camket_dungsuthat == "true" ? 1 : 0;
            $license->camket_chaphanhdungquydinh = $request->camket_chaphanhdungquydinh == "true" ? 1 : 0;
            $license->camket_daguihoso = $request->camket_daguihoso == "true" ? 1 : 0;
            $license->status = 0;
            $license->save();

            $hangmuc = json_decode($request->hangmuc);
            foreach ($hangmuc as $key => $data) {
                NuocMatHangMuc::create([
                  'idgiayphep'   =>  $license->id,
                  'tenhangmuc'   =>  $data->tenhangmuc,
                  'x'            =>  $data->x,
                  'y'            =>  $data->y,
                ]);
            }
            
            // LUU FILE UPLOAD
            $currentYear = Carbon::now()->format('Y');
            $destinationPath = 'uploads/'.$currentYear.'/khai-thac-nuoc-mat/';
            $files = $request->file();
            foreach($files as $file)
            {
                $fileName = $license->id.'-'.$file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
            }

            $SoDoViTriCongTrinhKhaiThac = $request->file('tailieu_sodovitrikhuvuc_congtrinh_khaithac');
            $DonXinCapPhep = $request->file('tailieu_donxincapphep');
            $DeanBaocaoKhaiThacSuDungNuoc = $request->file('tailieu_baocaodean_ktsd');
            $KetQuaPTCLN = $request->file('tailieu_ketqua_ptcln');
            $BaoCaoHienTrangKhaiThac = $request->file('tailieu_baocaohientrangkhaithac');
            $VanBanYKienCongDong = $request->file('tailieu_vanban_yccd');            
            $GiayToKhac = $request->file('tailieu_giaytokhac');

            $tailieu = new TaiLieuNuocMat($request->all()); 
            $tailieu->idgiayphep = $license->id;
            $tailieu->tailieu_nam = Carbon::now()->format('Y');
            $tailieu->tailieu_loaigiayphep = 'khai-thac-nuoc-mat';
            $tailieu->tailieu_donxincapphep = $license->id.'-'.$DonXinCapPhep->getClientOriginalName();
            $tailieu->tailieu_sodovitrikhuvuc_congtrinh_khaithac = $license->id.'-'.$SoDoViTriCongTrinhKhaiThac->getClientOriginalName();
            $tailieu->tailieu_baocaodean_ktsd = $license->id.'-'.$DeanBaocaoKhaiThacSuDungNuoc->getClientOriginalName();
            $tailieu->tailieu_baocaohientrangkhaithac = $license->id.'-'.$BaoCaoHienTrangKhaiThac->getClientOriginalName();
            $tailieu->tailieu_ketqua_ptcln = $license->id.'-'.$KetQuaPTCLN->getClientOriginalName();
            $tailieu->tailieu_vanban_yccd = $license->id.'-'.$VanBanYKienCongDong->getClientOriginalName();
            $tailieu->tailieu_giaytokhac = $license->id.'-'.$GiayToKhac->getClientOriginalName();
            $tailieu->save();

            return response()->json(['success_message' => 'Xin cấp mới giấy phép thành công, vui lòng chờ phê duyệt !' ]);
        }
    }

    // SUA GIAY PHEP
    public function editLicense(ThuyDien $id_gp, Request $request)
    {
        $messages = [
            'chugiayphep_ten.required' => 'Vui lòng nhập tên cá nhân / tổ chức đề nghị cấp phép', 
            'chugiayphep_diachi.required' => 'Vui lòng nhập địa chỉ', 
            'congtrinh_ten.required' => 'Vui lòng nhập tên công trình',
            'congtrinh_diadiem.required' => 'Vui lòng nhập địa chỉ công trình',
            'phuongthuc_kt.required' => 'Vui lòng nhập phương thức khai thác',
            'congsuat_lapmay.required' => 'Vui lòng nhập công suất lắp máy',
            'congsuat_lapmay.numeric' => 'Vui lòng nhập công suất lắp máy hợp lệ',
            'luuluonglonnhat_quathuydien.required' => 'Vui lòng nhập lưu lượng lớn nhất qua nhà máy thủy điện',
            'luuluonglonnhat_quathuydien.regex' => 'Vui lòng nhập lưu lượng lớn nhất qua nhà máy thủy điện đúng định dạng số thập phân VD: 21.34',
            'mucnuocdang_binhthuong.required' => 'Vui lòng nhập mực nước dâng bình thường',
            'mucnuocdang_binhthuong.regex' => 'Vui lòng nhập mực nước dâng bình thường đúng định dạng số thập phân VD: 21.34',
            'mucnuoc_chet.required' => 'Vui lòng nhập mực nước chết',
            'mucnuoc_chet.regex' => 'Vui lòng nhập mực nước chết đúng định dạng số thập phân VD: 21.34',
            'mucnuoccaonhat_truoclu.required' => 'Vui lòng nhập mực nước cao nhất trước lũ',
            'mucnuoccaonhat_truoclu.regex' => 'Vui lòng nhập mực nước cao nhất trước lũ đúng định dạng số thập phân VD: 21.34',
            'mucnuoc_donlu.required' => 'Vui lòng nhập mực nước đón lũ',
            'mucnuoc_donlu.regex' => 'Vui lòng nhập mực nước đón lũ đúng định dạng số thập phân VD: 21.34',
            'dungtich_huuich.required' => 'Vui lòng nhập dung tích hữu ích',
            'dungtich_huuich.regex' => 'Vui lòng nhập dung tích hữu ích đúng định dạng số thập phân VD: 21.34',
            'dungtich_toanbo.required' => 'Vui lòng nhập dung tích toàn bộ',
            'dungtich_toanbo.regex' => 'Vui lòng nhập dung tích toàn bộ đúng định dạng số thập phân VD: 21.34',
            'luuluong_xadongchay_toithieu.required' => 'Vui lòng nhập lưu lượng xả dòng chảy tối thiểu',
            'luuluong_xadongchay_toithieu.regex' => 'Vui lòng nhập lưu lượng xả dòng chảy tối thiểu đúng định dạng số thập phân VD: 21.34',
            'nguonnuoc_ktsd.required' => 'Vui lòng nhập nguồn nước khai thác sử dụng',
            'mucdich_ktsd.required' => 'Vui lòng nhập mục đích khai thác sử dụng',
            'luuluongnuoc_ktsd.required' => 'Vui lòng nhập lượng nước khai thác sử dụng',
            'luuluongnuoc_ktsd.regex' => 'Vui lòng nhập lượng nước khai thác sử dụng đúng định dạng số thập phân VD: 21.34',
            'gp_thoihangiayphep.required' => 'Vui lòng nhập thời hạn giấy phép',
            'camket_dungsuthat.numeric' => 'Vui lòng chọn cam kết đúng sự thật',
            'camket_chaphanhdungquydinh.numeric' => 'Vui lòng chọn cam kết đúng quy định',
            'hangmuc.required' => 'Vui lòng nhập hạng mục công trình'
        ];

        $validator = Validator::make($request->all(), [
            'chugiayphep_ten' => 'required', 
            'chugiayphep_diachi' => 'required',  
            'congtrinh_ten' => 'required', 
            'congtrinh_diadiem' => 'required', 
            'phuongthuc_kt' => 'required',
            'congsuat_lapmay' => 'required|numeric',
            'luuluonglonnhat_quathuydien' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuocdang_binhthuong' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuoc_chet' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuoccaonhat_truoclu' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'mucnuoc_donlu' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'dungtich_huuich' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'dungtich_toanbo' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'luuluong_xadongchay_toithieu' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'nguonnuoc_ktsd' => 'required',
            'mucdich_ktsd' => 'required', 
            'luuluongnuoc_ktsd' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'gp_thoihangiayphep' => 'required',
            'camket_dungsuthat' => 'required',
            'camket_chaphanhdungquydinh' => 'required',
            'hangmuc' => 'required'
        ], $messages);
   
        if($validator->fails()){
            $messages = $validator->errors()->all();
            $msg = $messages[0];
            return response()->json(['error_message' => $msg], 400);       
        }else{
            $id_gp->fill($request->all());
            $id_gp->user_id = $request->user()->id;
            $id_gp->gp_loaigiayphep = 'cap-moi';
            $id_gp->camket_dungsuthat = $request->camket_dungsuthat == "true" ? 1 : 0;
            $id_gp->camket_chaphanhdungquydinh = $request->camket_chaphanhdungquydinh == "true" ? 1 : 0;
            $id_gp->camket_daguihoso = $request->camket_daguihoso == "true" ? 1 : 0;
            $id_gp->save();

            
            $deleteOldData = NuocMatHangMuc::where('idgiayphep', $id_gp->id)->delete();

            $hangmucRequest = json_decode($request->hangmuc);
            foreach ($hangmucRequest as $key => $data) {
                NuocMatHangMuc::create([
                  'idgiayphep'   =>  $id_gp->id,
                  'tenhangmuc'   =>  $data->tenhangmuc,
                  'x'            =>  $data->x,
                  'y'            =>  $data->y,
                ]);
            }
            
            // Save uploaded files
            $currentYear = Carbon::now()->format('Y');
            $destinationPath = 'uploads/'.$currentYear.'/khai-thac-nuoc-mat/';
            $files = $request->file();
            foreach($files as $file)
            {
                if($file->getClientOriginalName()){
                    $fileName = $id_gp->id.'-'.$file->getClientOriginalName();
                    $file->move($destinationPath, $fileName);
                }
            }

            return response()->json(['success_message' => 'Chỉnh sửa giấy phép thành công !' ]);
        }
    }

    // DANH SACH HO SO DA CAP PHEP THEO TAI KHOAN NGUOI DUNG
    public function grantedLicenseByUser($loaiCongTrinh, $user_id)
    {
        $role = User::where('id',$user_id)->get()->pluck('role')[0];

        if($role == 'admin' || $role == 'lanh-dao' ){
            $gp_thuydien = ThuyDien::where('status', 1)->get();
            return $gp_thuydien;
        } 
        else if ($role == 'chu-giay-phep'){
            $gp_thuydien = ThuyDien::where('user_id', $user_id)->where('status', 1)->get();
            return $gp_thuydien;
        }
        else {
            return null;
        }        
    }

    // DANH SACH HO SO CAP MOI THEO TAI KHOAN NGUOI DUNG
    public function newLicenseByUser($loaiCongTrinh, $user_id)
    {
        $role = User::where('id',$user_id)->get()->pluck('role')[0];

        if($role == 'admin' || $role == 'lanh-dao' ){
            $gp_thuydien = ThuyDien::where('gp_loaigiayphep', 'cap-moi')->where('status', 0)->get();
            return $gp_thuydien;
        }
        else if ($role == 'chu-giay-phep'){
            $gp_thuydien = ThuyDien::where('gp_loaigiayphep', 'cap-moi')->where('user_id', $user_id)->where('status', 0)->get();
            return $gp_thuydien;
        }
        else {
            return null;
        }        
    }

    // DANH SACH HO SO GIA HAN THEO TAI KHOAN NGUOI DUNG
    public function extendLicenseByUser($loaiCongTrinh, $user_id)
    {
        $role = User::where('id',$user_id)->get()->pluck('role')[0];

        if($role == 'admin' || $role == 'lanh-dao' ){
            $gp_thuydien = ThuyDien::where('gp_loaigiayphep', 'gia-han')->where('status', 0)->get();
            return $gp_thuydien;
        }
        else if ($role == 'chu-giay-phep'){
            $gp_thuydien = ThuyDien::where('gp_loaigiayphep', 'gia-han')->where('user_id', $user_id)->where('status', 0)->get();
            return $gp_thuydien;
        }
        else {
            return null;
        }        
    }

    // DANH SACH HO SO THU HOI THEO TAI KHOAN NGUOI DUNG
    public function recallLicenseByUser($loaiCongTrinh, $user_id)
    {
        $role = User::where('id',$user_id)->get()->pluck('role')[0];

        if($role == 'admin' || $role == 'lanh-dao' ){
            $gp_thuydien = ThuyDien::where('gp_loaigiayphep', 'thu-hoi')->where('status', 0)->get();
            return $gp_thuydien;
        }
        else if ($role == 'chu-giay-phep'){
            $gp_thuydien = ThuyDien::where('gp_loaigiayphep', 'thu-hoi')->where('user_id', $user_id)->where('status', 0)->get();
            return $gp_thuydien;
        }
        else {
            return null;
        }        
    }
}
