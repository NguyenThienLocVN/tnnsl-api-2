<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GPNuocMat;
use App\Models\NuocMatHangMuc;
use App\Models\TaiLieuNuocMat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GPNuocMatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // list all Face water license
    public function filterLicense($constructionType, $status){
        $license = GPNuocMat::all();
        // gp thủy điện
        $gp_thuydien = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_thuydien = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp hồ chứa
        $gp_hochua = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'ho-chua')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_hochua = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'ho-chua')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp trạm bơm
        $gp_trambom = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'tram-bom')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_trambom = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'tram-bom')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp đập/ hệ thống thủy lợi
        $gp_dap = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'dap')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_dap = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'dap')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp Cống
        $gp_cong = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'cong')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_cong = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'cong')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp trạm cấp nước
        $gp_tramcapnuoc = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_tramcapnuoc = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp nhà máy nước
        $gp_nhamaynuoc = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_nhamaynuoc = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp công trình khác
        $gp_congtrinhkhac = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_congtrinhkhac = GPNuocMat::where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();
        return [
                'gp_all' => $license,
                'gp_thuydien' => $gp_thuydien,
                'tonggp_thuydien' => $tonggp_thuydien,
                'gp_hochua' => $gp_hochua,
                'tonggp_hochua' => $tonggp_hochua,
                'gp_dap' => $gp_dap,
                'tonggp_dap' => $tonggp_dap,
                'gp_cong' => $gp_cong,
                'tonggp_cong' => $tonggp_cong,
                'gp_trambom' => $gp_trambom,
                'tonggp_trambom' => $tonggp_trambom,
                'gp_tramcapnuoc' => $gp_tramcapnuoc,
                'tonggp_tramcapnuoc' => $tonggp_tramcapnuoc,
                'gp_nhamaynuoc' => $gp_nhamaynuoc,
                'tonggp_nhamaynuoc' => $tonggp_nhamaynuoc,
                'gp_congtrinhkhac' => $gp_congtrinhkhac,
                'tonggp_congtrinhkhac' => $tonggp_congtrinhkhac
        ];
    }

    // countLicenceNumber
    public function countLicenceNumber(){

        $currentDate = Carbon::now();

        $allgp = GPNuocMat::all()->count();
        // gp chưa được duyệt
        $allChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        // gp còn hiệu lực
        $allConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        // gp sắp hết hiệu lực
        $allSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $allHetHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp thủy điện
        $allgp_thuydien = GPNuocMat::where('congtrinh_loaihinh_ktsd','thuy-dien')->count();

        $gp_thuydienGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'thuy-dien')->get()->count();

        $gp_thuydienChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'thuy-dien')->get()->count();

        $gp_thuydienConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_thuydienSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'thuy-dien')->get()->count();

        $gp_thuydienHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp hồ chứa
        $allgp_hochua = GPNuocMat::where('congtrinh_loaihinh_ktsd','ho-chua')->count();

        $gp_hochuaGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'ho-chua')->get()->count();

        $gp_hochuaChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'ho-chua')->get()->count();

        $gp_hochuaConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'ho-chua')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_hochuaSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'ho-chua')->get()->count();

        $gp_hochuaHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'ho-chua')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp đập
        $allgp_dap = GPNuocMat::where('congtrinh_loaihinh_ktsd','dap')->count();

        $gp_dapGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'dap')->get()->count();

        $gp_dapChuaDuocDuyet = GPNuocMat::whereIn('status', [0,2,3])->where('congtrinh_loaihinh_ktsd', 'dap')->get()->count();

        $gp_dapConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'dap')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_dapSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'dap')->get()->count();

        $gp_dapHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'dap')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp cống
        $allgp_cong = GPNuocMat::where('congtrinh_loaihinh_ktsd','cong')->count();

        $gp_congGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong')->get()->count();

        $gp_congChuaDuocDuyet = GPNuocMat::whereIn('status', [0,2,3])->where('congtrinh_loaihinh_ktsd', 'cong')->get()->count();

        $gp_congConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_congSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'cong')->get()->count();

        $gp_congHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp trạm bơm
        $allgp_trambom = GPNuocMat::where('congtrinh_loaihinh_ktsd','tram-bom')->count();

        $gp_trambomGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'tram-bom')->get()->count();

        $gp_trambomChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'tram-bom')->get()->count();

        $gp_trambomConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'tram-bom')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_trambomSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'tram-bom')->get()->count();

        $gp_trambomHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'tram-bom')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp trạm cấp nước
        $allgp_tramcapnuoc = GPNuocMat::where('congtrinh_loaihinh_ktsd','tram-cap-nuoc')->count();

        $gp_tramcapnuocGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->get()->count();

        $gp_tramcapnuocChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->get()->count();

        $gp_tramcapnuocConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_tramcapnuocSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->get()->count();

        $gp_tramcapnuocHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'tram-cap-nuoc')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp nhà máy nước
        $allgp_nhamaynuoc = GPNuocMat::where('congtrinh_loaihinh_ktsd','nha-may-nuoc')->count();

        $gp_nhamaynuocGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->get()->count();

        $gp_nhamaynuocChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->get()->count();

        $gp_nhamaynuocConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_nhamaynuocSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->get()->count();

        $gp_nhamaynuocHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'nha-may-nuoc')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp công trình khác
        $allgp_congtrinhkhac = GPNuocMat::where('congtrinh_loaihinh_ktsd','cong-trinh-khac')->count();

        $gp_congtrinhkhacGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_congtrinhkhacSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->where('gp_ngayhethan','<',$currentDate)->get()->count();



        return [
            'tat_ca_gp_nuoc_mat' => [
                'allgp' => $allgp,
                'chua_phe_duyet' => $allChuaDuocDuyet,
                'con_hieu_luc' => $allConHieuLuc,
                'sap_het_hieu_luc' => $allSapHetHieuLuc,
                'het_hieu_luc' => $allHetHieuLuc,
            ],
            'thuy_dien' => [
                'tat_ca_giay_phep' => $allgp_thuydien,
                'giay_phep_da_cap' => $gp_thuydienGPDaCap,
                'chua_phe_duyet' => $gp_thuydienChuaDuocDuyet,
                'con_hieu_luc' => $gp_thuydienConHieuLuc,
                'sap_het_hieu_luc' => $gp_thuydienSapHetHieuLuc,
                'het_hieu_luc' => $gp_thuydienHetHieuLuc,
            ],
            'ho_chua' => [
                'tat_ca_giay_phep' => $allgp_hochua,
                'giay_phep_da_cap' => $gp_hochuaGPDaCap,
                'chua_phe_duyet' => $gp_hochuaChuaDuocDuyet,
                'con_hieu_luc' => $gp_hochuaConHieuLuc,
                'sap_het_hieu_luc' => $gp_hochuaSapHetHieuLuc,
                'het_hieu_luc' => $gp_hochuaHetHieuLuc,
            ],
            'dap' => [
                'tat_ca_giay_phep' => $allgp_dap,
                'giay_phep_da_cap' => $gp_dapGPDaCap,
                'chua_phe_duyet' => $gp_dapChuaDuocDuyet,
                'con_hieu_luc' => $gp_dapConHieuLuc,
                'sap_het_hieu_luc' => $gp_dapSapHetHieuLuc,
                'het_hieu_luc' => $gp_dapHetHieuLuc,
            ],
            'cong' => [
                'tat_ca_giay_phep' => $allgp_cong,
                'giay_phep_da_cap' => $gp_congGPDaCap,
                'chua_phe_duyet' => $gp_congChuaDuocDuyet,
                'con_hieu_luc' => $gp_congConHieuLuc,
                'sap_het_hieu_luc' => $gp_congSapHetHieuLuc,
                'het_hieu_luc' => $gp_congHetHieuLuc,
            ],
            'tram_bom' => [
                'tat_ca_giay_phep' => $allgp_trambom,
                'giay_phep_da_cap' => $gp_trambomGPDaCap,
                'chua_phe_duyet' => $gp_trambomChuaDuocDuyet,
                'con_hieu_luc' => $gp_trambomConHieuLuc,
                'sap_het_hieu_luc' => $gp_trambomSapHetHieuLuc,
                'het_hieu_luc' => $gp_trambomHetHieuLuc,
            ],
            'tram_cap_nuoc' => [
                'tat_ca_giay_phep' => $allgp_tramcapnuoc,
                'giay_phep_da_cap' => $gp_tramcapnuocGPDaCap,
                'chua_phe_duyet' => $gp_tramcapnuocChuaDuocDuyet,
                'con_hieu_luc' => $gp_tramcapnuocConHieuLuc,
                'sap_het_hieu_luc' => $gp_tramcapnuocSapHetHieuLuc,
                'het_hieu_luc' => $gp_tramcapnuocHetHieuLuc,
            ],
            'nha_may_nuoc' => [
                'tat_ca_giay_phep' => $allgp_nhamaynuoc,
                'giay_phep_da_cap' => $gp_nhamaynuocGPDaCap,
                'chua_phe_duyet' => $gp_nhamaynuocChuaDuocDuyet,
                'con_hieu_luc' => $gp_nhamaynuocConHieuLuc,
                'sap_het_hieu_luc' => $gp_nhamaynuocSapHetHieuLuc,
                'het_hieu_luc' => $gp_nhamaynuocHetHieuLuc,
            ],
            'cong_trinh_khac' => [
                'tat_ca_giay_phep' => $allgp_congtrinhkhac,
                'giay_phep_da_cap' => $gp_congtrinhkhacGPDaCap,
                'chua_phe_duyet' => $gp_congtrinhkhacChuaDuocDuyet,
                'con_hieu_luc' => $gp_congtrinhkhacConHieuLuc,
                'sap_het_hieu_luc' => $gp_congtrinhkhacSapHetHieuLuc,
                'het_hieu_luc' => $gp_congtrinhkhacHetHieuLuc,
            ],
        ];
    }

    // hydroelectricLicenseInfo
    public function hydroelectricLicenseInfo($id_gp){
        $hangMuc = GPNuocMat::find($id_gp)->hang_muc_ct->toArray();
        $licenseInfo = GPNuocMat::where('id', $id_gp)->with('tai_lieu')->get();

        return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];
    }

    // TrafficAccordingToThePurposeOfUse
    public function TrafficAccordingToThePurposeOfUse($id_gp){
        $license =  GPNuocMat::find($id_gp);
        return $license->luu_luong_theo_muc_dich_sd;
    }

    // chat_luong_nuoc_mat_qcvn
    public function chat_luong_nuoc_mat_qcvn(){
        return ChatLuongNuocMatQCVN::all();
    }

    // Thong tin cong trinh hien thi tren ban do
    public function hydroelectricContructionInfoForMap($loaiCongTrinh)
    {
        $licenses = GPNuocMat::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->paginate(10);

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
                        'detailContent' => "<div> <h5 class='card-title fw-bold font-13'>".$item->hang_muc_ct[0]->tenhangmuc.' - '.$item->congtrinh_ten."</h5> <table class='table table-striped table-hover mb-2'> <tbody> <tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ X</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->x."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ Y</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->y."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Địa điểm</td><td class='col-8 py-1'>".$item->congtrinh_diadiem."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Số GP</td><td class='col-8 py-1'>".$item->gp_sogiayphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Ngày cấp</td><td class='col-8 py-1'>".$item->gp_thoihangiayphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1 font-11'>Cấp thẩm quyền</td><td class='col-8 py-1'>".$item->gp_donvi_thamquyen."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Chủ giấy phép</td><td class='col-8 py-1'>".$item->chugiayphep_ten."</td></tr></tbody> </table> <Link to={'/quan-ly-cap-phep/nuoc-duoi-dat/khai-thac/xem-thong-tin-chung/'+$item->id} class='card-link d-block text-center'>Chi tiết công trình</Link></div>"
                    ],
                    'id' => $item->id
                ]);
            }
        }
        $infoJson = json_encode($infoArray, JSON_UNESCAPED_UNICODE);
        return $infoJson;
    }

    // Loc cong trinh thuy dien
    public function filterHydroelectricLicense($loaiCongTrinh, $status)
    {
        $currentDate = Carbon::now();

        $all = GPNuocMat::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

        $chuaPheDuyet = GPNuocMat::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

        $conHieuLuc = GPNuocMat::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

        $sapHetHieuLuc = GPNuocMat::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

        $hetHieuLuc = GPNuocMat::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->where('status', '1')->where("gp_thoihangiayphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
    public function destroyLicense($id_gp)
    {
        $destroyLicense = GPNuocMat::find($id_gp);
        $destroyLicense->delete();  
        return response()->json(['success_message' => 'Xóa giấy phép thành công !' ]);
    }

    // Tao moi giay phep
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
            'chugiayphep_sogiaydangkykinhdoanh' => 'required', 
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
            $license = new GPNuocMat($request->all());
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
            
            // Save uploaded files
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

    // Chinh sua giay phep
    public function editLicense(GPNuocMat $id_gp, Request $request)
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
            'chugiayphep_sogiaydangkykinhdoanh' => 'required', 
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
            $id_gp->fill($request->all());
            $id_gp->user_id = $request->user()->id;
            $id_gp->gp_loaigiayphep = 'cap-moi';
            $id_gp->camket_dungsuthat = $request->camket_dungsuthat == "true" ? 1 : 0;
            $id_gp->camket_chaphanhdungquydinh = $request->camket_chaphanhdungquydinh == "true" ? 1 : 0;
            $id_gp->camket_daguihoso = $request->camket_daguihoso == "true" ? 1 : 0;
            $id_gp->status = 0;
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

    // Quan ly yeu cau cap moi
    public function RequestLicenseManagement($user_id, $license_status)
    {
        $role = User::where('id',$user_id)->get()->pluck('role');

        // role admin
        $adminAll = GPNuocMat::whereIn('status', [0,1,2,3])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $adminNopHoSo = GPNuocMat::whereIn('status', [0])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $adminDangLayYKienThamDinh = GPNuocMat::whereIn('status', [2])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $adminHoanThanhHoSoCapPhep = GPNuocMat::whereIn('status', [3])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $adminDaDuocCapPhep = GPNuocMat::whereIn('status', [1])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();

        // role user
        $userAll = GPNuocMat::where('user_id',$user_id)->whereIn('status', [0,1,2,3])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $userNopHoSo = GPNuocMat::where('user_id',$user_id)->whereIn('status', [0])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $userDangLayYKienThamDinh = GPNuocMat::where('user_id',$user_id)->whereIn('status', [2])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $userHoanThanhHoSoCapPhep = GPNuocMat::where('user_id',$user_id)->whereIn('status', [3])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();
        $userDaDuocCapPhep = GPNuocMat::where('user_id',$user_id)->whereIn('status', [1])->with('hang_muc_ct')->with('tai_lieu')->orderBy('id', 'DESC')->get();

        if($role[0] == "admin"){
            if($license_status == "all"){
                return $adminAll;
            }elseif($license_status == "2"){
                return $adminDangLayYKienThamDinh;
            }elseif($license_status == "0"){
                return $adminNopHoSo;
            }elseif($license_status == "3"){
                return $adminHoanThanhHoSoCapPhep;
            }elseif($license_status == "1"){
                return $adminDaDuocCapPhep;
            }
        }elseif($role[0] == "user"){
            if($license_status == "all"){
                return $userAll;
            }elseif($license_status == "2"){
                return $userDangLayYKienThamDinh;
            }elseif($license_status == "0"){
                return $userNopHoSo;
            }elseif($license_status == "3"){
                return $userHoanThanhHoSoCapPhep;
            }elseif($license_status == "1"){
                return $userDaDuocCapPhep;
            }
        }
    }
}
