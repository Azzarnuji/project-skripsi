<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\GuruModel;
use App\Models\WebSekolahModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Web;

class WebHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $x['galeri']=WebSekolahModel::get_galeri_home();
        $x['brt']=WebSekolahModel::get_berita_slider();
        $x['berita']=WebSekolahModel::get_berita_home();
        $x['pengumuman']=WebSekolahModel::get_pengumuman_home();
        $x['agenda']=WebSekolahModel::get_agenda_home();
        $x['download']=WebSekolahModel::get_files_home();
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());

        // dd($x['berita']);
        return view('Home.Home', $x);
    }

    public function kataSambutan(){
        return view('Home.KataSambutan');
    }

    public function visiMisi(){
        return view('Home.VisiMisi');
    }

    public function guru(){
        $x['data']= WebSekolahModel::guru()->paginate(7);
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();
        return view('Home.Guru',$x);
    }

    public function siswa(){
        $x['data']= WebSekolahModel::siswa()->paginate(7);
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();

        return view('Home.Siswa',$x);
    }

    public function prestasiSiswa(){
        return view('Home.PrestasiSiswa');
    }

    public function berita(){
        $x['data']= WebSekolahModel::berita()->paginate(7);
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->orderBy('tulisan_id', 'DESC')->limit(7)->get();
        $x['tulisan_populer'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_views', 'DESC')->limit(7)->get();

        return view('Home.Berita',$x);
    }

    public function beritaDetail($id) {
        $x['data']= WebSekolahModel::get_berita_by_kode($id);
        DB::connection('web-sekolah')->table('tbl_tulisan')
            ->where('tulisan_id', $id)
            ->update(['tulisan_views' => DB::raw('tulisan_views + 1')]);
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();
        $x['tulisan_populer'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_views', 'DESC')->limit(7)->get();

        return view('Home.BeritaDetail',$x);
    }

    public function pengumuman(){
        $x['data']= WebSekolahModel::pengumuman()->paginate(7);
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();
        $x['tulisan_populer'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_views', 'DESC')->limit(7)->get();
        return view('Home.Pengumuman',$x);
    }

    public function agenda(){
        $x['data'] = WebSekolahModel::agenda()->paginate(7);
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();
        $x['tulisan_populer'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_views', 'DESC')->limit(7)->get();

        return view('Home.Agenda',$x);
    }

    public function galeri(){
        $x['alb']= WebSekolahModel::get_all_album();
        $x['all_galeri'] = WebSekolahModel::get_all_galeri();
        return view('Home.Galeri',$x);
    }

    public function album($id){
        $x['alb']= WebSekolahModel::get_all_album();
        $x['data']=WebSekolahModel::get_galeri_by_album_id($id);
        return view('Home.GaleriPerAlbum',$x);
    }

    public function download(){
        $x['data']= WebSekolahModel::get_all_files();
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();

        return view('Home.Download',$x);
    }

    public function download_file($id){
        $dataQuery = WebSekolahModel::get_file_byid($id);
        return response()->download(public_path('/assets/web-sekolah/assets/files/').$dataQuery->file_data);
    }

    public function kontak(){
        $x['data_siswa'] = DB::connection('web-sekolah')->table('tbl_siswa')->orderBy('siswa_id', 'DESC')->limit(4)->get();
        // $x['data_guru'] = DB::connection('web-sekolah')->table('tbl_guru')->orderBy('guru_id', 'DESC')->limit(4)->get();
        $x['data_guru'] = json_encode(GuruModel::limit(4)->get()->all());
        $x['tulisan'] = DB::connection('web-sekolah')->table('tbl_tulisan')->select('tbl_tulisan.*', DB::raw("DATE_FORMAT(tulisan_tanggal, '%d/%m/%Y') AS tanggal"))->where('tulisan_img_slider', '=', '0')->orderBy('tulisan_id', 'DESC')->limit(7)->get();

        return view('Home.Kontak',$x);
    }

    public function download_file_format(){
        return response()->download(public_path('assets/document/Format-Import-Data-Siswa.xlsx'));
    }
}
