<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\GuruModel;
use App\Models\PPDBModel;
use Illuminate\Http\Request;
use App\Models\UpcomingPaymentsModel;


class WebGuruTUController extends Controller
{
    protected $decodeToken;
    public function __construct()
    {
        $this->decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
    }
    public function dashboard(Request $request){
        $profile = GuruModel::where('email',$this->decodeToken['profile']->email)->first();
        $data = [
            'title' => 'Dashboard',
            'profile'=>$profile,
            'datas'=>[
                'pendingPembayaranCount'=>UpcomingPaymentsModel::where('status','pending')->count(),
                'lunasPembayaranCount'=>UpcomingPaymentsModel::where('status','lunas')->count(),
                'listPendingPembayaran'=>UpcomingPaymentsModel::where('status','pending')->orderBy('created_at','DESC')->with('PembayaranTable')->with(['UsersTable'=>function($query){
                    $query->with('detail');
                }])->limit(5)->get()->all()
            ]
        ];
        return view('Dashboard.GuruTU.GuruTUDashboard',$data);
    }

    public function ppdb(Request $request){
        $profile = GuruModel::where('email',$this->decodeToken['profile']->email)->first();
        $data = [
            'title'=>"PPDB",
            'profile'=>$profile,
            'datas'=>[
                'listPPDB'=>PPDBModel::where('status','pending')->with('DetailUser')->get()->all()
            ]
        ];
        return view('Dashboard.GuruTU.GuruTU_PPDB',$data);
    }

    public function pembayaran(Request $request){
        $profile = GuruModel::where('email',$this->decodeToken['profile']->email)->first();
        $uangPending = collect(UpcomingPaymentsModel::where('status','pending')->with('PembayaranTable')->get()->all())->sum('PembayaranTable.nominal');
        $uangLunas = collect(UpcomingPaymentsModel::where('status','lunas')->with('PembayaranTable')->get()->all())->sum('PembayaranTable.nominal');
        $uangTolak = collect(UpcomingPaymentsModel::where('status','tolak')->with('PembayaranTable')->get()->all())->sum('PembayaranTable.nominal');
        // dd($uangPending, $uangLunas, $uangTolak);
        $data = [
            'title'=>"Pembayaran",
            'profile'=>$profile,
            'datas'=>[
                'pendingPembayaranCount'=>UpcomingPaymentsModel::where('status','pending')->count(),
                'lunasPembayaranCount'=>UpcomingPaymentsModel::where('status','lunas')->count(),
                'listPendingPembayaran'=>UpcomingPaymentsModel::where('status','pending')->orderBy('created_at','DESC')->with('PembayaranTable')->with(['UsersTable'=>function($query){
                    $query->with('detail');
                }])->get()->all(),
                'uangPending'=>$uangPending,
                'uangLunas'=>$uangLunas,
                'uangTolak'=>$uangTolak
            ]
        ];
        return view('Dashboard.GuruTU.GuruTUPembayaran',$data);
    }

    public function dataSiswa(Request $request){
        $data = [
            'title' => 'Data Siswa',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
        ];
        return view('Dashboard.GuruTU.GuruTUDataSiswa',$data);
    }
}
