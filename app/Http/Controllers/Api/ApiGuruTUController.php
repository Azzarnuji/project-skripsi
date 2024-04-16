<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utils;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Imports\UsersDetailImport;
use App\Models\BankUjianModel;
use App\Models\KelasModel;
use App\Models\KelasSiswaModel;
use App\Models\PPDBModel;
use App\Models\StartUjianModel;
use App\Models\UpcomingPaymentsModel;
use App\Models\UsersDetail;
use Maatwebsite\Excel\Facades\Excel;

class ApiGuruTUController extends Controller
{
    //
    public function detailSiswa($email,$idPembayaran){
        try {
            $data = UsersModel::where('email',$email)->with('detail')->with(['UpcomingPayment'=>function($query) use($idPembayaran){
                $query->where('pembayaran_id_foreign',$idPembayaran)->with(['PembayaranTable'=>function($query){
                    $query->withTrashed();
                }]);
            }])->first();
            return response()->json(Utils::generateResponseTemplate('success',200,'Success get data', $data), 200);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function detailPPDB($email){
        try {
            $ppdb = PPDBModel::where('email',$email)->with('DetailUser')->first();
            $kelas = KelasModel::where('kelas','x')->get()->all();
            $data = [
                'ppdb' => $ppdb,
                'kelas' => $kelas
            ];
            return response()->json(Utils::generateResponseTemplate('success',200,'Success get data', $data), 200);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function updateStatusPembayaranDaftarBaru(Request $request){
        $emailSiswa = $request->input('EmailSiswa');
        $statusPembayaran =  $request->input('StatusPembayaran');
        $dataUjian = BankUjianModel::where('ujian_untuk','daftar_baru')->first();
        switch ($statusPembayaran) {
            case 'Diterima':
                $statusPembayaran = 'lunas';
                break;
            case 'Ditolak':
                $statusPembayaran = 'tolak';
                break;
            default:
                $statusPembayaran = 'pending';
                break;
        }
        DB::beginTransaction();
        try {
            UpcomingPaymentsModel::where('email',$emailSiswa)->update([
                'status' => $statusPembayaran
            ]);
            if($statusPembayaran == 'lunas'){
                StartUjianModel::create([
                    'ujian_id' => $dataUjian->ujian_id,
                    'email'=>$emailSiswa,
                    'minimal_nilai'=>$dataUjian->minimal_nilai,
                ]);
            }
            DB::commit();
            return redirect()->to('guru_tu/pembayaran/?message=Berhasil Mengubah Status Pembayaran');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function getDataByFilter($filter){
        $data = UpcomingPaymentsModel::where('status',$filter)->orderBy('created_at','DESC')->with(['PembayaranTable'=>function($query){
            $query->withTrashed();
        }])->with(['UsersTable'=>function($query){
            $query->with('detail');
        }])->get()->all();
        return response()->json(Utils::generateResponseTemplate('success',200,'Success get data', $data), 200);
    }

    public function updatStatusPPDBCalonSiswa(Request $request){
        $emailCalonSiswa = $request->input('EmailSiswa');
        $statusPPDB =  $request->input('StatusPPDB');
        $kelasSiswa = $request->input('KelasSiswa');

        DB::beginTransaction();
        try {
            // dd($dataPPDB);
            PPDBModel::where('email',$emailCalonSiswa)->update([
                'status' => $statusPPDB == 'Diterima' ? 'active' : 'decline'
            ]);
            $dataPPDB = PPDBModel::where('email',$emailCalonSiswa)->firstOrFail(['nis','nisn','TTL','nama_ayah','pekerjaan_ayah','alamat_ayah','no_hp_ayah','nama_ibu','pekerjaan_ibu','alamat_ibu','no_hp_ibu','status','image']);
            UsersDetail::where('email',$emailCalonSiswa)->update($dataPPDB->toArray());
            KelasSiswaModel::create([
                'id_kelas_foreign'=>$kelasSiswa,
                'email_foreign' => $emailCalonSiswa,
            ]);
            DB::commit();
            return redirect()->to('guru_tu/ppdb/?message=Berhasil Mengubah Status PPDB');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function getSubKelas($kelas){
        $data  = KelasModel::where('kelas',$kelas)->get()->all();

        if($data){
            return response()->json(Utils::generateResponseTemplate('OK',200,'Get Sub Kelas Success',$data),200);
        }else{

            return response()->json(Utils::generateResponseTemplate('Not OK',404,'Sub Kelas Not Found',null),404);
        }
    }

    public function getSiswaByKelas($kelas){

        $data = KelasSiswaModel::where('id_kelas_foreign',$kelas)->with('DetailKelas')->with('DetailSiswa')->get()->all();
        if($data){
            return response()->json(Utils::generateResponseTemplate('OK',200,'Get Siswa Success',$data),200);
        }else{
            return response()->json(Utils::generateResponseTemplate('Not OK',404,'Siswa Not Found',null),404);
        }
    }

    public function tambahListSiswa(Request $request){
        try {
            Excel::import(new UsersDetailImport, $request->file('fileImport'), readerType:\Maatwebsite\Excel\Excel::XLSX);
            return redirect()->to('admin/data-siswa/?message=Data Siswa Berhasil Ditambahkan');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
