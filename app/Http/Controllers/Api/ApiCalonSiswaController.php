<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Data\RoleUser;
use App\Helpers\Utils;
use App\Models\PPDBModel;
use App\Models\UjianModel;
use App\Models\UsersModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BankUjianModel;
use Illuminate\Support\Carbon;
use App\Models\StartUjianModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiCalonSiswaController extends Controller
{
    //

    private function checkJawaban($dataSoal,$nomorSoal, $jawabanSiswa){

        $kunciJawaban = collect($dataSoal)->where('nomor_soal',$nomorSoal)->first();
        return $kunciJawaban->jawaban_benar == Str::upper(key($jawabanSiswa));
    }
    public function ujian(Request $request,$ujianID){
        // dd($request->all());
        $decodeToken = (array)Utils::getValueToken($_COOKIE['token']);
        $dataSoal = UjianModel::where('ujian_id',$ujianID)->get()->all();
        $dataUjian = BankUjianModel::where('ujian_id',$ujianID)->first();
        $jawabanUjianSiswa = $request->input('Jawaban');
        $jawabanBenar = 0;
        $jawabanSalah = 0;
        foreach($jawabanUjianSiswa as $key=>$value){
            $checkJawaban = $this->checkJawaban($dataSoal,$key, json_decode($value, true));
            if($checkJawaban == true){
                $jawabanBenar += 1;
            }else{
                $jawabanSalah += 1;
            }
        }
        $data = [
            'nilai_ujian'=>$jawabanBenar * (int)$dataUjian->bobot_nilai,
            'jawaban_benar'=>$jawabanBenar,
            'jawaban_salah'=>$jawabanSalah,
            'status_ujian'=>'selesai'
        ];
        // dd($jawabanBenar,$data['nilai_ujian'],$data['nilai_ujian'] >= $dataUjian->minimal_nilai ? 'lulus' : 'tidak');
        $data['status_kelulusan'] = $data['nilai_ujian'] >= $dataUjian->minimal_nilai ? 'lulus' : 'tidak_lulus';
        DB::beginTransaction();
        try {
            StartUjianModel::where('email',$decodeToken['profile']->email)->where('ujian_id',$ujianID)->update($data);
            StartUjianModel::where('email',$decodeToken['profile']->email)->touch();
            DB::commit();
            return redirect()->to('calon_siswa/dashboard/?message=Ujian Telah Selesai');
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function ppdb(Request $request){
        // Data Diri
        $email = $request->input('Email');
        $namaLengkap = $request->input('NamaLengkap');
        $asalSekolah = $request->input('AsalSekolah');
        $nisn = $request->input('NISN');
        $nis = $request->input('NIS');
        $tempatTanggalLahir = $request->input('TempatTanggalLahir');
        $fotoDiri = $request->file('FotoDiri');

        // Data Ayah
        $namaAyah = $request->input('NamaAyah');
        $alamatAyah = $request->input('AlamatAyah');
        $pekerjaanAyah = $request->input('PekerjaanAyah');
        $nomorTeleponAyah = $request->input('NomorTeleponAyah');

        // Data Ibu
        $namaIbu = $request->input('NamaIbu');
        $alamatIbu = $request->input('AlamatIbu');
        $pekerjaanIbu = $request->input('PekerjaanIbu');
        $nomorTeleponIbu = $request->input('NomorTeleponIbu');


        $fileName = $email.'-'. Carbon::now()->format('Y-m-d_H-i-s').'.'.$fotoDiri->extension();
        $fotoDiri->move('assets/foto-siswa/',$fileName);
        // Insert to database
        $data = [
            'email'=>$email,
            'nama_lengkap'=>$namaLengkap,
            'asal_sekolah'=>$asalSekolah,
            'nisn'=>$nisn,
            'nis'=>$nis,
            'TTL'=>$tempatTanggalLahir,
            'nama_ayah'=>$namaAyah,
            'alamat_ayah'=>$alamatAyah,
            'pekerjaan_ayah'=>$pekerjaanAyah,
            'no_hp_ayah'=>$nomorTeleponAyah,
            'nama_ibu'=>$namaIbu,
            'alamat_ibu'=>$alamatIbu,
            'pekerjaan_ibu'=>$pekerjaanIbu,
            'no_hp_ibu'=>$nomorTeleponIbu,
            'status'=>'pending',
            'image'=>$fileName
        ];
        DB::beginTransaction();
        try {
            PPDBModel::create($data);
            DB::commit();
            return redirect()->to('calon_siswa/dashboard/?message=Data PPDB Telah Di Isi');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
