<?php

namespace App\Http\Controllers\api\QuanLyCapPhep\NuocMat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



// THUY DIEN
use App\Models\QuanLyCapPhep\NuocMat\ThuyDien;

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

    // DEM GIAY PHEP
    public function countLicenceNumber(){
        // NGAY HIEN TAI
        $currentDate = Carbon::now();

        // THUY DIEN
        $allgp_thuydien = ThuyDien::all()->count();

        $gp_thuydienGPDaCap = ThuyDien::where('status', '1')->get()->count();

        $gp_thuydienChuaDuocDuyet = ThuyDien::where('status', '0')->get()->count();

        $gp_thuydienConHieuLuc = ThuyDien::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_thuydienSapHetHieuLuc = ThuyDien::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_thuydienHetHieuLuc = ThuyDien::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // HO CHUA
        $allgp_hochua = HoChua::all()->count();

        $gp_hochuaGPDaCap = HoChua::where('status', '1')->get()->count();

        $gp_hochuaChuaDuocDuyet = HoChua::where('status', '0')->get()->count();

        $gp_hochuaConHieuLuc = HoChua::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_hochuaSapHetHieuLuc = HoChua::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_hochuaHetHieuLuc = HoChua::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // DAP
        $allgp_dap = GPNuocMat::where('congtrinh_loaihinh_ktsd','dap')->count();

        $gp_dapGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'dap')->get()->count();

        $gp_dapChuaDuocDuyet = GPNuocMat::whereIn('status', [0,2,3])->where('congtrinh_loaihinh_ktsd', 'dap')->get()->count();

        $gp_dapConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'dap')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_dapSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'dap')->get()->count();

        $gp_dapHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'dap')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // CONG
        $allgp_cong = GPNuocMat::where('congtrinh_loaihinh_ktsd','cong')->count();

        $gp_congGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong')->get()->count();

        $gp_congChuaDuocDuyet = GPNuocMat::whereIn('status', [0,2,3])->where('congtrinh_loaihinh_ktsd', 'cong')->get()->count();

        $gp_congConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_congSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'cong')->get()->count();

        $gp_congHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // TRAM BOM
        $allgp_trambom = TramBom::all()->count();

        $gp_trambomGPDaCap = TramBom::where('status', '1')->get()->count();

        $gp_trambomChuaDuocDuyet = TramBom::where('status', '0')->get()->count();

        $gp_trambomConHieuLuc = TramBom::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_trambomSapHetHieuLuc = TramBom::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_trambomHetHieuLuc = TramBom::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // TRAM CAP NUOC
        $allgp_tramcapnuoc = TramCapNuoc::all()->count();

        $gp_tramcapnuocGPDaCap = TramCapNuoc::where('status', '1')->get()->count();

        $gp_tramcapnuocChuaDuocDuyet = TramCapNuoc::where('status', '0')->get()->count();

        $gp_tramcapnuocConHieuLuc = TramCapNuoc::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_tramcapnuocSapHetHieuLuc = TramCapNuoc::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_tramcapnuocHetHieuLuc = TramCapNuoc::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // NHA MAY NUOC
        $allgp_nhamaynuoc = NhaMayNuoc::all()->count();

        $gp_nhamaynuocGPDaCap = NhaMayNuoc::where('status', '1')->get()->count();

        $gp_nhamaynuocChuaDuocDuyet = NhaMayNuoc::where('status', '0')->get()->count();

        $gp_nhamaynuocConHieuLuc = NhaMayNuoc::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_nhamaynuocSapHetHieuLuc = NhaMayNuoc::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_nhamaynuocHetHieuLuc = NhaMayNuoc::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // CT KHAC
        $allgp_congtrinhkhac = GPNuocMat::where('congtrinh_loaihinh_ktsd','cong-trinh-khac')->count();

        $gp_congtrinhkhacGPDaCap = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacChuaDuocDuyet = GPNuocMat::where('status', '0')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacConHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_congtrinhkhacSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->get()->count();

        $gp_congtrinhkhacHetHieuLuc = GPNuocMat::where('status', '1')->where('congtrinh_loaihinh_ktsd', 'cong-trinh-khac')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // TAT CA
        $allGp = $allgp_thuydien + $allgp_hochua + $allgp_dap + $allgp_cong + $allgp_trambom + $allgp_tramcapnuoc + $allgp_nhamaynuoc + $allgp_congtrinhkhac;
        // GIAY PHEP CHUA DUOC DUYET
        $allChuaDuocDuyet = $gp_thuydienChuaDuocDuyet + $gp_hochuaChuaDuocDuyet + $gp_dapChuaDuocDuyet + $gp_congChuaDuocDuyet + $gp_trambomChuaDuocDuyet + $gp_tramcapnuocChuaDuocDuyet + $gp_nhamaynuocChuaDuocDuyet + $gp_congtrinhkhacChuaDuocDuyet;
        // GIAY PHEP CON HIEU LUC
        $allConHieuLuc = $gp_thuydienConHieuLuc + $gp_hochuaConHieuLuc + $gp_dapConHieuLuc + $gp_congConHieuLuc + $gp_trambomConHieuLuc + $gp_tramcapnuocConHieuLuc + $gp_nhamaynuocConHieuLuc + $gp_congtrinhkhacConHieuLuc;
        // GIAY PHEP SAP HET HIEU LUC
        $allSapHetHieuLuc = $gp_thuydienSapHetHieuLuc + $gp_hochuaSapHetHieuLuc + $gp_dapSapHetHieuLuc + $gp_congSapHetHieuLuc + $gp_trambomSapHetHieuLuc + $gp_tramcapnuocSapHetHieuLuc + $gp_nhamaynuocSapHetHieuLuc + $gp_congtrinhkhacSapHetHieuLuc;
        // GIAY PHEP HET HIEU LUC
        $allHetHieuLuc = $gp_thuydienHetHieuLuc + $gp_hochuaHetHieuLuc + $gp_dapHetHieuLuc + $gp_congHetHieuLuc + $gp_trambomHetHieuLuc + $gp_tramcapnuocHetHieuLuc + $gp_nhamaynuocHetHieuLuc + $gp_congtrinhkhacHetHieuLuc;

        return [
            'tat_ca_gp_nuoc_mat' => [
                'allgp' => $allGp,
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


    // THONG TIN GIAY PHEP
    public function hydroelectricLicenseInfo($loaiCongTrinh, $id_gp){
        if($loaiCongTrinh == 'thuy-dien'){
            $hangMuc = ThuyDien::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = ThuyDien::where('id', $id_gp)->with('tai_lieu')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'tram-bom'){

            $hangMuc = TramBom::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = TramBom::where('id', $id_gp)->with('tai_lieu')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'ho-chua'){

            $hangMuc = HoChua::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = HoChua::where('id', $id_gp)->with('tai_lieu')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'tram-cap-nuoc'){

            $hangMuc = TramCapNuoc::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = TramCapNuoc::where('id', $id_gp)->with('tai_lieu')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'nha-may-nuoc'){

            $hangMuc = NhaMayNuoc::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = NhaMayNuoc::where('id', $id_gp)->with('tai_lieu')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }else{
            $hangMuc = GPNuocMat::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = GPNuocMat::where('id', $id_gp)->with('tai_lieu')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];
        }
    }


    // THONG TIN CONG TRINH TREN BAN DO
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

    // LOC HIEU LUC GIAY PHEP
    public function filterHydroelectricLicense($loaiCongTrinh, $status)
    {
        $currentDate = Carbon::now();

        if($loaiCongTrinh == 'thuy-dien'){
            $all = ThuyDien::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

            $chuaPheDuyet = ThuyDien::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

            $conHieuLuc = ThuyDien::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

            $sapHetHieuLuc = ThuyDien::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

            $hetHieuLuc = ThuyDien::where('status', '1')->where("gp_thoihangiayphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
        elseif($loaiCongTrinh == 'ho-chua'){
            $all = HoChua::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

            $chuaPheDuyet = HoChua::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

            $conHieuLuc = HoChua::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

            $sapHetHieuLuc = HoChua::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

            $hetHieuLuc = HoChua::where('status', '1')->where("gp_thoihangiayphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
        elseif($loaiCongTrinh == 'tram-bom'){
            $all = TramBom::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

            $chuaPheDuyet = TramBom::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

            $conHieuLuc = TramBom::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

            $sapHetHieuLuc = TramBom::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

            $hetHieuLuc = TramBom::where('status', '1')->where("gp_thoihangiayphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
        elseif($loaiCongTrinh == 'tram-cap-nuoc'){
            $all = TramCapNuoc::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

            $chuaPheDuyet = TramCapNuoc::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

            $conHieuLuc = TramCapNuoc::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

            $sapHetHieuLuc = TramCapNuoc::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

            $hetHieuLuc = TramCapNuoc::where('status', '1')->where("gp_thoihangiayphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
        elseif($loaiCongTrinh == 'nha-may-nuoc'){
            $all = NhaMayNuoc::where('congtrinh_loaihinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->get();

            $chuaPheDuyet = NhaMayNuoc::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->get();

            $conHieuLuc = NhaMayNuoc::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

            $sapHetHieuLuc = NhaMayNuoc::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->get();

            $hetHieuLuc = NhaMayNuoc::where('status', '1')->where("gp_thoihangiayphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->get();

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
        else{
            return [];
        }
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
