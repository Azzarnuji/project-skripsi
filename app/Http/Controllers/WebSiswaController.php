<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\PPDBModel;
use Illuminate\Http\Request;
use App\Models\KelasSiswaModel;
use App\Models\PembayaranModel;
use App\Models\BankPembayaranModel;
use App\Models\UpcomingPaymentsModel;
use App\Models\UsersDetail;
use Carbon\Carbon;

class WebSiswaController extends Controller
{
    //
    public function dashboard(){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $data = [
            'title' => 'Pembayaran',
            'profile'=>UsersDetail::where('email',$decodeToken['profile']->email)->with(['Kelas'=>function($query){
                $query->with('DetailKelas');
            }])->first()
        ];
        return view('Dashboard.Siswa.SiswaDashboard',$data);
    }
    public function pembayaran(){
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $getDataBayarSiswa = UpcomingPaymentsModel::where('email',$decodeToken['profile']->email)->where('status','belum_bayar')->with('PembayaranTable')->get()->all();
        // dd($getDataBayarSiswa);
        $data = [
            'title' => 'Pembayaran',
            'profile'=>UsersDetail::where('email',$decodeToken['profile']->email)->with(['Kelas'=>function($query){
                $query->with('DetailKelas');
            }])->first(),
            'datas'=>[
                'metodePembayaran'=>BankPembayaranModel::all(),
                'listWajibBayar'=>$getDataBayarSiswa,
                'historyPembayaran'=>UpcomingPaymentsModel::where('email',$decodeToken['profile']->email)->orderBy('created_at','DESC')->with(['PembayaranTable'=>function($query){
                    $query->withTrashed();
                }])->get()->all()
            ]
        ];
        return view('Dashboard.Siswa.SiswaPembayaran',$data);
    }

    public function siswaLama(Request $request){
        $data = [
            'title' => 'Siswa Lama',
        ];
        return view('Dashboard.Siswa.Siswa_SiswaLama',$data);
    }
}
