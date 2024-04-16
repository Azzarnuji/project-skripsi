<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use Illuminate\Http\Request;
use App\Models\PembayaranModel;
use App\Models\StartUjianModel;
use App\Models\BankPembayaranModel;
use App\Models\PPDBModel;
use App\Models\UjianModel;
use App\Models\UpcomingPaymentsModel;


class WebCalonSiswaController extends Controller
{
    //
    public function dashboard(){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $dataUjian = StartUjianModel::where('email',$decodeToken['profile']->email)->with('BankUjian')->get()->all();
        $data = [
            'title' => 'Dashboard',
            'profile'=>Utils::convertStdClassToArray($decodeToken),
            'statusPembayaran'=>UpcomingPaymentsModel::where('email',$decodeToken['profile']->email)->first(),
            'datas'=>[
                'listMetodePembayaran'=>BankPembayaranModel::all(),
                'biayaDaftarBaru'=>PembayaranModel::where('untuk_kelas','daftar_baru')->first(),
                'statusPembayaran'=>UpcomingPaymentsModel::with('PembayaranTable')->where('email',$decodeToken['profile']->email)->get()->all(),
                'listUjian'=>$dataUjian,
                'statusKelulusan'=>isset($dataUjian[0]->status_kelulusan) == true ? $dataUjian[0]->status_kelulusan : 'belum_ujian',
            ]
        ];
        return view('Dashboard.CalonSiswa.CalonSiswaDashboard',$data);
    }

    public function pembayaran(){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $data = [
            'title' => 'Pembayaran',
            'data'=>Utils::convertStdClassToArray($decodeToken)
        ];
        return view('Dashboard.CalonSiswa.CalonSiswaDashboard',$data);
    }

    public function ujian($ujianID){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $checkUjian = StartUjianModel::where('ujian_id',$ujianID)->where('email',$decodeToken['profile']->email)->first();
        if($checkUjian->status_ujian == 'selesai'){
            return redirect()->to('calon_siswa/dashboard/?message=Ujian Sudah Selesai');
        }
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $data = [
            'title' => 'Ujian',
            'profile'=>Utils::convertStdClassToArray($decodeToken),
            'datas'=>[
                'ujianID'=>$ujianID,
                'soal'=>UjianModel::where('ujian_id',$ujianID)->get()->all(),
                'statusKelulusan'=>StartUjianModel::with('BankUjian')->where('email',$decodeToken['profile']->email)->first()->status_kelulusan,

            ]
        ];
        return view('Dashboard.CalonSiswa.CalonSiswaUjianBaru',$data);
    }
    public function hasilUjian(Request $request, $ujianID){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $dataUjian = StartUjianModel::with('BankUjian')->where('email',$decodeToken['profile']->email)->first();
        $data = [
            'title' => 'Hasil Ujian',
            'profile'=>Utils::convertStdClassToArray($decodeToken),
            'datas'=>[
                'statusKelulusan'=>$dataUjian->status_kelulusan,
                'dataUjian'=>$dataUjian,
            ]
        ];
        return view('Dashboard.CalonSiswa.CalonSiswaHasilUjian',$data);
    }

    public function ppdb(Request $request){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $dataUjian = StartUjianModel::with('BankUjian')->where('email',$decodeToken['profile']->email)->first();
        $statusPPDB = PPDBModel::where('email',$decodeToken['profile']->email)->first();
        $data = [
            'title' => 'PPDB',
            'profile'=>Utils::convertStdClassToArray($decodeToken),
            'datas'=>[
                'statusKelulusan'=>$dataUjian->status_kelulusan,
                'statusPPDB'=>isset($statusPPDB) == true ? $statusPPDB->status : 'belum_daftar',
            ]
        ];
        return view('Dashboard.CalonSiswa.CalonSiswaPPDB',$data);
    }
}
