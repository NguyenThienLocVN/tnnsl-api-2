<?php

namespace App\Http\Controllers\api\QuanLyCapPhep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Models Giay Phep
// NuocMat
use App\Models\QuanlyCapPhep\NuocMat\ThuyDien\ThuyDienGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\HoChua\HoChuaGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\TramBom\TramBomGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\TramCapNuoc\TramCapNuocGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\NhaMayNuoc\NhaMayNuocGiayPhep;

// NuocDuoiDat
use App\Models\QuanlyCapPhep\NuocDuoiDat\KhaiThac\KhaiThacGiayPhep;
use App\Models\QuanlyCapPhep\NuocDuoiDat\ThamDo\ThamDoGiayPhep;
use App\Models\QuanlyCapPhep\NuocDuoiDat\HanhNgheKhoan\HanhNgheKhoanGiayPhep;


class QuanLyCapPhepController extends Controller
{
    public function countLicense()
    {
        $currentDate = Carbon::now();

        // NuocMat-----------------------------------------------------------------
        // gp_thuydien
        $allgp_thuydien = ThuyDienGiayPhep::all()->count();
        $gp_thuydienGPDaCap = ThuyDienGiayPhep::where('status', '1')->get()->count();
        $gp_thuydienChuaDuocDuyet = ThuyDienGiayPhep::where('status', '0')->get()->count();
        $gp_thuydienConHieuLuc = ThuyDienGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_thuydienSapHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_thuydienHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_hochua
        $allgp_hochua = HoChuaGiayPhep::all()->count();
        $gp_hochuaGPDaCap = HoChuaGiayPhep::where('status', '1')->get()->count();
        $gp_hochuaChuaDuocDuyet = HoChuaGiayPhep::where('status', '0')->get()->count();
        $gp_hochuaConHieuLuc = HoChuaGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_hochuaSapHetHieuLuc = HoChuaGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_hochuaHetHieuLuc = HoChuaGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        
        // gp_trambom
        $allgp_trambom = TramBomGiayPhep::all()->count();
        $gp_trambomGPDaCap = TramBomGiayPhep::where('status', '1')->get()->count();
        $gp_trambomChuaDuocDuyet = TramBomGiayPhep::where('status', '0')->get()->count();
        $gp_trambomConHieuLuc = TramBomGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_trambomSapHetHieuLuc = TramBomGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_trambomHetHieuLuc = TramBomGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        
        // gp_tramcapnuoc
        $allgp_tramcapnuoc = TramCapNuocGiayPhep::all()->count();
        $gp_tramcapnuocGPDaCap = TramCapNuocGiayPhep::where('status', '1')->get()->count();
        $gp_tramcapnuocChuaDuocDuyet = TramCapNuocGiayPhep::where('status', '0')->get()->count();
        $gp_tramcapnuocConHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_tramcapnuocSapHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_tramcapnuocHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        
        // gp_nhamaynuoc
        $allgp_nhamaynuoc = NhaMayNuocGiayPhep::all()->count();
        $gp_nhamaynuocGPDaCap = NhaMayNuocGiayPhep::where('status', '1')->get()->count();
        $gp_nhamaynuocChuaDuocDuyet = NhaMayNuocGiayPhep::where('status', '0')->get()->count();
        $gp_nhamaynuocConHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_nhamaynuocSapHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_nhamaynuocHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        


        // NuocDuoiDat-----------------------------------------------------------------

        // gp_ktnuocduoidat
        $allgp_ktnuocduoidat = KhaiThacGiayPhep::all()->count();
        $gp_ktnuocduoidatGPDaCap = KhaiThacGiayPhep::where('status', '1')->get()->count();
        $gp_ktnuocduoidatChuaDuocDuyet = KhaiThacGiayPhep::where('status', '0')->get()->count();
        $gp_ktnuocduoidatConHieuLuc = KhaiThacGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_ktnuocduoidatSapHetHieuLuc = KhaiThacGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_ktnuocduoidatHetHieuLuc = KhaiThacGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_tdnuocduoidat
        $allgp_tdnuocduoidat = ThamDoGiayPhep::all()->count();
        $gp_tdnuocduoidatGPDaCap = ThamDoGiayPhep::where('status', '1')->get()->count();
        $gp_tdnuocduoidatChuaDuocDuyet = ThamDoGiayPhep::where('status', '0')->get()->count();
        $gp_tdnuocduoidatConHieuLuc = ThamDoGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_tdnuocduoidatSapHetHieuLuc = ThamDoGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_tdnuocduoidatHetHieuLuc = ThamDoGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();
        
        // gp_khoannuocduoidat
        $allgp_khoannuocduoidat = HanhNgheKhoanGiayPhep::all()->count();
        $gp_khoannuocduoidatGPDaCap = HanhNgheKhoanGiayPhep::where('status', '1')->get()->count();
        $gp_khoannuocduoidatChuaDuocDuyet = HanhNgheKhoanGiayPhep::where('status', '0')->get()->count();
        $gp_khoannuocduoidatConHieuLuc = HanhNgheKhoanGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_khoannuocduoidatSapHetHieuLuc = HanhNgheKhoanGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_khoannuocduoidatHetHieuLuc = HanhNgheKhoanGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        return [

            'gp_nuocmat' => [
                'tat_ca_giay_phep' => $allgp_thuydien + $allgp_hochua + $allgp_trambom + $allgp_tramcapnuoc + $allgp_nhamaynuoc,
                'giay_phep_da_cap' => $gp_thuydienGPDaCap + $gp_hochuaGPDaCap + $gp_trambomGPDaCap + $gp_tramcapnuocGPDaCap + $gp_nhamaynuocGPDaCap,
                'chua_phe_duyet' => $gp_thuydienChuaDuocDuyet + $gp_hochuaChuaDuocDuyet + $gp_trambomChuaDuocDuyet + $gp_tramcapnuocChuaDuocDuyet + $gp_nhamaynuocChuaDuocDuyet,
                'con_hieu_luc' => $gp_thuydienConHieuLuc + $gp_hochuaConHieuLuc + $gp_trambomConHieuLuc + $gp_tramcapnuocConHieuLuc + $gp_nhamaynuocConHieuLuc,
                'sap_het_hieu_luc' => $gp_thuydienSapHetHieuLuc + $gp_hochuaSapHetHieuLuc + $gp_trambomSapHetHieuLuc + $gp_tramcapnuocSapHetHieuLuc + $gp_nhamaynuocSapHetHieuLuc,
                'het_hieu_luc' => $gp_thuydienHetHieuLuc + $gp_hochuaHetHieuLuc + $gp_trambomHetHieuLuc + $gp_tramcapnuocHetHieuLuc + $gp_nhamaynuocHetHieuLuc,
            ],
            'gp_nuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_ktnuocduoidat + $allgp_tdnuocduoidat + $allgp_khoannuocduoidat,
                'giay_phep_da_cap' => $gp_ktnuocduoidatGPDaCap + $gp_tdnuocduoidatGPDaCap + $gp_khoannuocduoidatGPDaCap,
                'chua_phe_duyet' => $gp_ktnuocduoidatChuaDuocDuyet + $gp_tdnuocduoidatChuaDuocDuyet + $gp_khoannuocduoidatChuaDuocDuyet,
                'con_hieu_luc' => $gp_ktnuocduoidatConHieuLuc + $gp_tdnuocduoidatConHieuLuc + $gp_khoannuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_ktnuocduoidatSapHetHieuLuc + $gp_tdnuocduoidatSapHetHieuLuc + $gp_khoannuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_ktnuocduoidatHetHieuLuc + $gp_tdnuocduoidatHetHieuLuc + $gp_khoannuocduoidatHetHieuLuc,
            ],
            'gp_xathai' => [
                'tat_ca_giay_phep' => 64,
                'giay_phep_da_cap' => 64,
                'chua_phe_duyet' => 0,
                'con_hieu_luc' => 47,
                'sap_het_hieu_luc' => 0,
                'het_hieu_luc' => 17,
            ],
        ];
    }

    // Dem giay phep theo loai giay phep
    public function countLicenseFolowType($startYear, $endYear)
    {
        $currentDate = Carbon::now();

        $label = [];

        $dataCharts = [
            'gp_nuocmat' => [],
            'gp_nuocduoidat' => [],
            'gp_xathai' => [5, 7, 7, 4, 2],
        ];

        $dataDoughnut = [
            'gp_nuocmat' => [],
            'gp_nuocduoidat' => [],
            'gp_xathai' => [5, 7, 7, 4, 2],
        ];

        for($i = $startYear ; $i<= $endYear ; $i++){
            array_push($label, (int)$i);
            // dataCharts-------------------------------------------------------------
            // NuocMat-------------------------------------------------------------------
            $count_thuydien = ThuyDienGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_hochua = HoChuaGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_trambom = TramBomGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_tramcapnuoc = TramCapNuocGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_nhamaynuoc = NhaMayNuocGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $gp_nuocmat =  $count_thuydien + $count_hochua + $count_trambom + $count_tramcapnuoc + $count_nhamaynuoc;

            array_push($dataCharts['gp_nuocmat'], $gp_nuocmat);
             // NuocDuoiDat-------------------------------------------------------------------
            $count_khaithac = KhaiThacGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_thamdo = ThamDoGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_khanhnghekhoan = TramBomGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $gp_nuocduoidat =  $count_khaithac + $count_thamdo + $count_khanhnghekhoan;
            array_push($dataCharts['gp_nuocduoidat'], $gp_nuocduoidat);

        }

        if( intval($startYear) < 2000 || intval($endYear) > $currentDate->format('Y')){
            $msg = "Dữ liệu chỉ hiển thị từ năm 2000 đến ".$currentDate->format('Y');
            return [
                'label' => [],
                'dataCharts' => [],
                'error_message' => $msg,
            ];
        }else{
            return [
            'label' => $label,
            'dataCharts' => $dataCharts,
            ];
        }
    }

    // DEM GIAY PHEP THEO LOAI
    public function countLicenceByType(){
        // NGAY HIEN TAI
        $currentDate = Carbon::now();

        // THUY DIEN
        $allgp_thuydien = ThuyDienGiayPhep::all()->count();

        $gp_thuydienGPDaCap = ThuyDienGiayPhep::where('status', '1')->get()->count();

        $gp_thuydienChuaDuocDuyet = ThuyDienGiayPhep::where('status', '0')->get()->count();

        $gp_thuydienConHieuLuc = ThuyDienGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_thuydienSapHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_thuydienHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // HO CHUA
        $allgp_hochua = HoChuaGiayPhep::all()->count();

        $gp_hochuaGPDaCap = HoChuaGiayPhep::where('status', '1')->get()->count();

        $gp_hochuaChuaDuocDuyet = HoChuaGiayPhep::where('status', '0')->get()->count();

        $gp_hochuaConHieuLuc = HoChuaGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_hochuaSapHetHieuLuc = HoChuaGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_hochuaHetHieuLuc = HoChuaGiayPhep::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // DAP
        $allgp_dap = 0;

        $gp_dapGPDaCap = 0;

        $gp_dapChuaDuocDuyet = 0;

        $gp_dapConHieuLuc = 0;

        $gp_dapSapHetHieuLuc = 0;

        $gp_dapHetHieuLuc = 0;

        // CONG
        $allgp_cong = 0;

        $gp_congGPDaCap = 0;

        $gp_congChuaDuocDuyet = 0;

        $gp_congConHieuLuc = 0;

        $gp_congSapHetHieuLuc = 0;

        $gp_congHetHieuLuc = 0;

        // TRAM BOM
        $allgp_trambom = TramBomGiayPhep::all()->count();

        $gp_trambomGPDaCap = TramBomGiayPhep::where('status', '1')->get()->count();

        $gp_trambomChuaDuocDuyet = TramBomGiayPhep::where('status', '0')->get()->count();

        $gp_trambomConHieuLuc = TramBomGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_trambomSapHetHieuLuc = TramBomGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_trambomHetHieuLuc = TramBomGiayPhep::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // TRAM CAP NUOC
        $allgp_tramcapnuoc = TramCapNuocGiayPhep::all()->count();

        $gp_tramcapnuocGPDaCap = TramCapNuocGiayPhep::where('status', '1')->get()->count();

        $gp_tramcapnuocChuaDuocDuyet = TramCapNuocGiayPhep::where('status', '0')->get()->count();

        $gp_tramcapnuocConHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_tramcapnuocSapHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_tramcapnuocHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // NHA MAY NUOC
        $allgp_nhamaynuoc = NhaMayNuocGiayPhep::all()->count();

        $gp_nhamaynuocGPDaCap = NhaMayNuocGiayPhep::where('status', '1')->get()->count();

        $gp_nhamaynuocChuaDuocDuyet = NhaMayNuocGiayPhep::where('status', '0')->get()->count();

        $gp_nhamaynuocConHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_nhamaynuocSapHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_nhamaynuocHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // CT KHAC
        $allgp_congtrinhkhac = 0;

        $gp_congtrinhkhacGPDaCap = 0;

        $gp_congtrinhkhacChuaDuocDuyet = 0;

        $gp_congtrinhkhacConHieuLuc = 0;

        $gp_congtrinhkhacSapHetHieuLuc = 0;

        $gp_congtrinhkhacHetHieuLuc = 0;

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

    // Loc danh sach giay phep theo hieu luc
    public function filterLicense($loaiCongTrinh, $status)
    {
        $currentDate = Carbon::now();

        if($loaiCongTrinh == 'thuy-dien'){
            $all = ThuyDienGiayPhep::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')
            ->join('nuocmat__thuydien__congtrinh', 'nuocmat__thuydien__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $chuaPheDuyet = ThuyDienGiayPhep::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__thuydien__congtrinh', 'nuocmat__thuydien__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $conHieuLuc = ThuyDienGiayPhep::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__thuydien__congtrinh', 'nuocmat__thuydien__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $sapHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__thuydien__congtrinh', 'nuocmat__thuydien__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $hetHieuLuc = ThuyDienGiayPhep::where('status', '1')->where("gp_thoigiancapphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__thuydien__congtrinh', 'nuocmat__thuydien__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

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
            $all = HoChuaGiayPhep::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__hochua__congtrinh', 'nuocmat__hochua__congtrinh.id', '=', 'nuocmat__hochua__giayphep.id_congtrinh')->get();

            $chuaPheDuyet = HoChuaGiayPhep::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__hochua__congtrinh', 'nuocmat__hochua__congtrinh.id', '=', 'nuocmat__hochua__giayphep.id_congtrinh')->get();

            $conHieuLuc = HoChuaGiayPhep::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__hochua__congtrinh', 'nuocmat__hochua__congtrinh.id', '=', 'nuocmat__hochua__giayphep.id_congtrinh')->get();

            $sapHetHieuLuc = HoChuaGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__hochua__congtrinh', 'nuocmat__hochua__congtrinh.id', '=', 'nuocmat__hochua__giayphep.id_congtrinh')->get();

            $hetHieuLuc = HoChuaGiayPhep::where('status', '1')->where("gp_thoigiancapphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__hochua__congtrinh', 'nuocmat__hochua__congtrinh.id', '=', 'nuocmat__hochua__giayphep.id_congtrinh')->get();

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
            $all = TramBomGiayPhep::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__trambom__congtrinh', 'nuocmat__trambom__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $chuaPheDuyet = TramBomGiayPhep::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__trambom__congtrinh', 'nuocmat__trambom__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $conHieuLuc = TramBomGiayPhep::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__trambom__congtrinh', 'nuocmat__trambom__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $sapHetHieuLuc = TramBomGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__trambom__congtrinh', 'nuocmat__trambom__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $hetHieuLuc = TramBomGiayPhep::where('status', '1')->where("gp_thoigiancapphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__trambom__congtrinh', 'nuocmat__trambom__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

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
            $all = TramCapNuocGiayPhep::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__tramcapnuoc__congtrinh', 'nuocmat__tramcapnuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $chuaPheDuyet = TramCapNuocGiayPhep::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__tramcapnuoc__congtrinh', 'nuocmat__tramcapnuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $conHieuLuc = TramCapNuocGiayPhep::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__tramcapnuoc__congtrinh', 'nuocmat__tramcapnuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $sapHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__tramcapnuoc__congtrinh', 'nuocmat__tramcapnuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $hetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where("gp_thoigiancapphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__tramcapnuoc__congtrinh', 'nuocmat__tramcapnuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

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
            $all = NhaMayNuocGiayPhep::where('loaihinh_congtrinh_ktsd', $loaiCongTrinh)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__nhamaynuoc__congtrinh', 'nuocmat__nhamaynuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $chuaPheDuyet = NhaMayNuocGiayPhep::where('status', '0')->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__nhamaynuoc__congtrinh', 'nuocmat__nhamaynuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $conHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->Where('gp_ngayhethan','>',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__nhamaynuoc__congtrinh', 'nuocmat__nhamaynuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $sapHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__nhamaynuoc__congtrinh', 'nuocmat__nhamaynuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

            $hetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where("gp_thoigiancapphep", '<>', '')->where('gp_ngayhethan','<>', "0000-00-00")->where('gp_ngayhethan','<',$currentDate)->with('hang_muc_ct')->with('tai_lieu')->join('nuocmat__nhamaynuoc__congtrinh', 'nuocmat__nhamaynuoc__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();

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

    // Hien thi thong tin giay phep theo ID
    public function showLicenseInfo($loaiCongTrinh, $id_gp){
        if($loaiCongTrinh == 'thuy-dien'){
            $hangMuc = ThuyDienGiayPhep::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = ThuyDienGiayPhep::where('nuocmat__thuydien__giayphep.id', $id_gp)->with('tai_lieu')->join('nuocmat__thuydien__congtrinh', 'nuocmat__thuydien__congtrinh.id', '=', 'nuocmat__thuydien__giayphep.id_congtrinh')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'tram-bom'){

            $hangMuc = TramBomGiayPhep::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = TramBomGiayPhep::where('id', $id_gp)->with('tai_lieu')->join('nuocmat__trambom__congtrinh', 'nuocmat__trambom__congtrinh.id', '=', 'nuocmat__trambom__giayphep.id_congtrinh')->select('')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'ho-chua'){

            $hangMuc = HoChuaGiayPhep::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = HoChuaGiayPhep::where('id', $id_gp)->with('tai_lieu')->join('nuocmat__hochua__congtrinh', 'nuocmat__hochua__congtrinh.id', '=', 'nuocmat__hochua__giayphep.id_congtrinh')->select('')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'tram-cap-nuoc'){

            $hangMuc = TramCapNuocGiayPhep::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = TramCapNuocGiayPhep::where('id', $id_gp)->with('tai_lieu')->join('nuocmat__tramcapnuoc__congtrinh', 'nuocmat__tramcapnuoc__congtrinh.id', '=', 'nuocmat__tramcapnuoc__giayphep.id_congtrinh')->select('')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }elseif($loaiCongTrinh == 'nha-may-nuoc'){

            $hangMuc = NhaMayNuocGiayPhep::find($id_gp)->hang_muc_ct->toArray();
            $licenseInfo = NhaMayNuocGiayPhep::where('id', $id_gp)->with('tai_lieu')->join('nuocmat__nhamaynuoc__congtrinh', 'nuocmat__nhamaynuoc__congtrinh.id', '=', 'nuocmat__nhamaynuoc__giayphep.id_congtrinh')->select('')->get();
            return ['licenseData' => $licenseInfo, 'hangmuc' => $hangMuc];

        }else{
            return [];
        }
    }
}
