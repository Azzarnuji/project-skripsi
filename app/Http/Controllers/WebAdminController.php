<?php

namespace App\Http\Controllers;

use App\Data\RoleUser;
use App\Helpers\Utils;
use App\Models\GuruModel;
use App\Models\PPDBModel;
use App\Models\KelasModel;
use App\Models\UjianModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use App\Models\BankUjianModel;
use App\Models\PembayaranModel;
use App\Models\BankPembayaranModel;
use App\Models\UpcomingPaymentsModel;
use App\Models\UsersDetail;
use App\Models\WebSekolahModel;
use Illuminate\Support\Facades\DB;

class WebAdminController extends Controller
{
    //
    protected $decodeToken;
    public function __construct()
    {
        $this->decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
    }
    public function dashboard(Request $request){
        $data = [
            'title' => 'Dashboard',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'datas'=>[
                'jumlahGuru'=>GuruModel::count(),
                'jumlahCalonSiswa'=>UsersModel::where('role',RoleUser::CALON_SISWA)->count(),
                'jumlahSiswaAktif'=>UsersDetail::where('status','active')->count(),
                'pendingPembayaran'=>UpcomingPaymentsModel::where('status','pending')->count(),
                'lunasPembayaran'=>UpcomingPaymentsModel::where('status','lunas')->count()
            ]
        ];

        return view('Dashboard.Admin.AdminDashboard',$data);
    }
    public function kelas(Request $request){
        $getAllKelas = KelasModel::with('pembayaran')->get()->all();
        $data = [
            'title' => 'Kelas',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'datas'=>[
                'getAllKelas'=>$getAllKelas,
                'guru'=>GuruModel::get()->all()
            ],
        ];
        return view('Dashboard.Admin.AdminKelas',$data);
    }
    public function guru(Request $request){
        $getAllGuru = GuruModel::get()->all();
        $data = [
            'title' => 'Guru',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'datas'=>$getAllGuru
        ];

        return view('Dashboard.Admin.AdminGuru',$data);
    }
    public function pembayaran(Request $request){
        $getAllPembayaran = PembayaranModel::get()->all();
        $getAllMetodePembayaran = BankPembayaranModel::get()->all();
        $data = [
            'title' => 'Pembayaran',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'datas'=>[
                'listPembayaran'=>$getAllPembayaran,
                'metodePembayaran'=>$getAllMetodePembayaran
            ]
        ];

        return view('Dashboard.Admin.AdminPembayaran',$data);
    }
    public function ujian(Request $request){
        $getAllBankSoal = BankUjianModel::with('Ujian')->get()->all();
        $data = [
            'title' => 'Ujian',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'data_ujian'=>$getAllBankSoal
        ];

        return view('Dashboard.Admin.AdminUjian',$data);
    }

    public function dataSiswa(Request $request){
        $data = [
            'title' => 'Data Siswa',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
        ];
        return view('Dashboard.Admin.AdminDataSiswa',$data);
    }

    public function berita(Request $request){
        $data = [
            'title' => 'Berita',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'data'=>[
                'berita'=>DB::connection('web-sekolah')->table('tbl_tulisan')
                ->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))
                ->orderBy('tulisan_id', 'DESC')
                ->get(),
                'kategori'=>DB::connection('web-sekolah')->select('select * from tbl_kategori')
            ]
        ];
        // dd($data);
        return view('Dashboard.Admin.AdminBerita',$data);
    }

    public function agenda(Request $request){
        $data = [
            'title' => 'Agenda',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'data'=>[
                'agenda'=>DB::connection('web-sekolah')->table('tbl_agenda')
                ->select('tbl_agenda.*', DB::raw("DATE_FORMAT(agenda_tanggal, '%d/%m/%Y') AS tanggal"))
                ->orderBy('agenda_id', 'DESC')
                ->get()
            ]
        ];
        return view('Dashboard.Admin.AdminAgenda',$data);
    }

    public function gallery(Request $request){
        $data = [
            'title' => 'Gallery',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'data'=>[
                'gallery'=>WebSekolahModel::get_all_galeri(),
                'album'=>WebSekolahModel::get_all_album()
            ]
        ];
        // dd($data);
        return view('Dashboard.Admin.AdminGallery',$data);
    }

    public function files(Request $request){
        $data = [
            'title' => 'Files',
            'profile'=>Utils::convertStdClassToArray($this->decodeToken),
            'data'=>[
                'files'=>WebSekolahModel::get_all_files()
            ]
        ];
        return view('Dashboard.Admin.AdminFiles',$data);
    }
}
