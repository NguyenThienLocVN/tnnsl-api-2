<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GPNuocMat;
use Carbon\Carbon;

class GPNuocMatController extends Controller
{
    // list all Face water license
    public function filterLicense($constructionType, $status){
        $license = GPNuocMat::all();
        // gp thủy điện
        $gp_thuydien = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_thuydien = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp hồ chứa
        $gp_hochua = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'ho-chua')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_hochua = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'ho-chua')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp trạm bơm
        $gp_trambom = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-bom')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_trambom = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-bom')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp đập/ hệ thống thủy lợi
        $gp_dap = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'dap')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_dap = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'dap')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp Cống
        $gp_cong = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'cong')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_cong = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'cong')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp trạm cấp nước
        $gp_tramcapnuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_tramcapnuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp nhà máy nước
        $gp_nhamaynuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_nhamaynuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();

        // gp công trình khác
        $gp_congtrinhkhac = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->paginate(10);
        $tonggp_congtrinhkhac = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->count();
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
        $allgp_thuydien = GPNuocMat::where('loaihinh_congtrinh_ktsd','thuy-dien')->count();

        $gp_thuydienGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->get()->count();

        $gp_thuydienChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->get()->count();

        $gp_thuydienConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_thuydienSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->get()->count();

        $gp_thuydienHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp hồ chứa
        $allgp_hochua = GPNuocMat::where('loaihinh_congtrinh_ktsd','ho-chua')->count();

        $gp_hochuaGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'ho-chua')->get()->count();

        $gp_hochuaChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'ho-chua')->get()->count();

        $gp_hochuaConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'ho-chua')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_hochuaSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'ho-chua')->get()->count();

        $gp_hochuaHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'ho-chua')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp đập
        $allgp_dap = GPNuocMat::where('loaihinh_congtrinh_ktsd','dap')->count();

        $gp_dapGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'dap')->get()->count();

        $gp_dapChuaDuocDuyet = GPNuocMat::whereIn('status', [0,2,3])->where('loaihinh_congtrinh_ktsd', 'dap')->get()->count();

        $gp_dapConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'dap')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_dapSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'dap')->get()->count();

        $gp_dapHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'dap')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp cống
        $allgp_cong = GPNuocMat::where('loaihinh_congtrinh_ktsd','cong')->count();

        $gp_congGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'cong')->get()->count();

        $gp_congChuaDuocDuyet = GPNuocMat::whereIn('status', [0,2,3])->where('loaihinh_congtrinh_ktsd', 'cong')->get()->count();

        $gp_congConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'cong')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_congSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'cong')->get()->count();

        $gp_congHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'cong')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp trạm bơm
        $allgp_trambom = GPNuocMat::where('loaihinh_congtrinh_ktsd','tram-bom')->count();

        $gp_trambomGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'tram-bom')->get()->count();

        $gp_trambomChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'tram-bom')->get()->count();

        $gp_trambomConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'tram-bom')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_trambomSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'tram-bom')->get()->count();

        $gp_trambomHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'tram-bom')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp trạm cấp nước
        $allgp_tramcapnuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd','tram-cap-nuoc')->count();

        $gp_tramcapnuocGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->get()->count();

        $gp_tramcapnuocChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->get()->count();

        $gp_tramcapnuocConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_tramcapnuocSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->get()->count();

        $gp_tramcapnuocHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp nhà máy nước
        $allgp_nhamaynuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd','nha-may-nuoc')->count();

        $gp_nhamaynuocGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->get()->count();

        $gp_nhamaynuocChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->get()->count();

        $gp_nhamaynuocConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_nhamaynuocSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->get()->count();

        $gp_nhamaynuocHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // gp công trình khác
        $allgp_congtrinhkhac = GPNuocMat::where('loaihinh_congtrinh_ktsd','cong-trinh-khac')->count();

        $gp_congtrinhkhacGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_congtrinhkhacSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->where('gp_ngayhethan','<',$currentDate)->get()->count();



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
        $LicenseInfo = GPNuocMat::with('hang_muc_ct')->find($id_gp);
        return $LicenseInfo;
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
        $licenses = GPNuocMat::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->paginate(10);

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
                        'detailContent' => "<div> <h5 class='card-title fw-bold font-13'>".$item->hang_muc_ct[0]->tenhangmuc.' - '.$item->congtrinh_ten."</h5> <table class='table table-striped table-hover mb-2'> <tbody> <tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ X</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->x."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Tọa độ Y</td><td class='col-8 py-1'>".$item->hang_muc_ct[0]->y."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Địa điểm</td><td class='col-8 py-1'>".$item->congtrinh_diadiem."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Số GP</td><td class='col-8 py-1'>".$item->gp_sogiayphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Ngày cấp</td><td class='col-8 py-1'>".$item->gp_thoigiancapphep."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1 font-11'>Cấp thẩm quyền</td><td class='col-8 py-1'>".$item->gp_donvi_thamquyen."</td></tr><tr class='col-12 d-flex p-0'> <td class='col-4 py-1'>Chủ giấy phép</td><td class='col-8 py-1'>".$item->chugiayphep_ten."</td></tr></tbody> </table> <Link to={'/quan-ly-cap-phep/nuoc-duoi-dat/khai-thac/xem-thong-tin-chung/'+$item->id} class='card-link d-block text-center'>Chi tiết công trình</Link></div>"
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

        $all = GPNuocMat::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

        $chuaPheDuyet = GPNuocMat::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

        $conHieuLuc = GPNuocMat::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

        $sapHetHieuLuc = GPNuocMat::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

        $hetHieuLuc = GPNuocMat::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->where('status', '1')->where("gp_thoigiancapphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
}
