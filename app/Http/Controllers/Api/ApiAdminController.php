<?php

namespace App\Http\Controllers\Api;

use App\Data\RoleUser;
use App\Helpers\Utils;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\UjianModel;
use App\Models\UsersModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BankUjianModel;
use App\Models\PembayaranModel;
use Illuminate\Support\Facades\DB;
use App\Models\BankPembayaranModel;
use App\Http\Controllers\Controller;
use App\Imports\UsersDetailImport;
use App\Models\KelasSiswaModel;
use App\Models\StartUjianModel;
use App\Models\UpcomingPaymentsModel;
use App\Models\WebSekolahModel;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ApiAdminController extends Controller
{
    //
    public function kelas(Request $request){
        DB::beginTransaction();
        try{
            $data = [
                'id_kelas'=>Str::uuid(),
                'kelas'=>$request->input('Kelas'),
                'sub_kelas'=>$request->input('SubKelas'),
                'wali_kelas'=>$request->input('WaliKelas')
            ];

            KelasModel::create($data);
            DB::commit();
            return redirect()->to('admin/kelas/?message=Kelas Berhasil Ditambahkan');
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->to('admin/kelas/?message=Kelas Gagal Ditambahkan');

        }
    }
    public function pembayaran(Request $request){
        DB::beginTransaction();
        try {
            $data = [
                'pembayaran_id'=>Str::uuid(),
                'nama_pembayaran' => $request->input('NamaPembayaran'),
                'nominal' => $request->input('Nominal'),
                'untuk_kelas' => $request->input('UntukKelas'),
            ];
            PembayaranModel::create($data);
            if($request->input('UntukKelas') != 'daftar_baru'){
                $allDataSiswa = KelasModel::where('kelas',$request->input('UntukKelas'))->with(['KelasSiswa'=>function($query){
                    $query->with('DetailSiswa');
                }])->get()->all();

                // dd($allDataSiswa);
                foreach($allDataSiswa as $allSiswa){
                    foreach($allSiswa['KelasSiswa'] as $kelasSiswa){
                        $dataUpcomingPayments = [
                            'pembayaran_id_foreign' => $data['pembayaran_id'],
                            'payment_id'=> Str::uuid(),
                            'email' => $kelasSiswa['email_foreign'],
                            'status' => 'belum_bayar'
                        ];

                        // var_dump($dataUpcomingPayments);
                        UpcomingPaymentsModel::create($dataUpcomingPayments);
                    }
                }
            }
            DB::commit();
            return redirect()->to('admin/pembayaran/?message=Pembayaran Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return redirect()->to('admin/pembayaran/?message=Pembayaran Gagal Ditambahkan');
        }
    }
    public function guru(Request $request){
        DB::beginTransaction();
        try{
            $data = [
                'nama_guru' => $request->input('NamaGuru'),
                'email'=>$request->input('EmailGuru'),
                'status_guru'=>$request->input('StatusGuru'),
                'mengajar_kelas'=> json_encode($request->input('Mengajar')),
            ];
            GuruModel::create($data);
            UsersModel::create([
                'email'=>$request->input('EmailGuru'),
                'password'=>password_hash("annurid",PASSWORD_BCRYPT),
                'role'=>$request->input('StatusGuru') == 'guru' ? RoleUser::GURU : RoleUser::GURU_TU
            ]);
            DB::commit();
            return redirect()->to('admin/guru/?message=Guru Berhasil Ditambahkan');
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->to('admin/guru/?message=Guru Gagal Ditambahkan');

        }
    }

    public function ujian(Request $request){
        $namaUjian = $request->input('NamaUjian');
        $UjianId = $request->input('UjianId');
        $UjianUntuk = $request->input('UjianUntuk');
        $soal = $request->input('Soal');
        $jawaban = $request->input('Jawaban');

        DB::beginTransaction();
        try {
            for($index = 1; $index <= sizeof($soal); $index++){
                $data = [
                    'ujian_id' => $UjianId,
                    'ujian_untuk'=> $UjianUntuk,
                    'nomor_soal' => $index,
                    'soal' => $soal[$index],
                    'jawaban_a' => $jawaban[$index]['A'],
                    'jawaban_b' => $jawaban[$index]['B'],
                    'jawaban_c' => $jawaban[$index]['C'],
                    'jawaban_d' => $jawaban[$index]['D'],
                    'jawaban_benar' => $jawaban[$index]['Jawaban_Benar'],
                ];
                UjianModel::create($data);
            }
            $dataBankUjian = [
                'ujian_id'=>$UjianId,
                'nama_ujian'=>$namaUjian,
                'ujian_untuk'=>$UjianUntuk,
                'jumlah_soal'=>$request->input('JumlahSoal'),
                'bobot_nilai'=>$request->input('BobotNilai'),
                'minimal_nilai'=>$request->input('NilaiMinimal')
            ];
            BankUjianModel::create($dataBankUjian);
            DB::commit();
            return redirect()->to('admin/ujian/?message=Ujian Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function tambahMetodePembayaran(Request $request){
        $namaBank = $request->input('NamaBank');
        $nomorRekening = $request->input('NoRekening');
        $namaPemilik = $request->input('NamaPemilik');
        DB::beginTransaction();
        try {
            $data = [
                'nama_bank' => $namaBank,
                'nomor_rekening' => $nomorRekening,
                'nama_pemilik' =>$namaPemilik
            ];
            BankPembayaranModel::create($data);
            DB::commit();
            return redirect()->to('admin/pembayaran/?message=Bank Berhasil Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function hapusUjian($ujianID){
        DB::beginTransaction();
        try {
            StartUjianModel::where('ujian_id',$ujianID)->delete('cascade');
            BankUjianModel::where('ujian_id',$ujianID)->delete('cascade');
            UjianModel::where('ujian_id',$ujianID)->delete('cascade');
            DB::commit();
            return redirect()->to('admin/ujian/?message=Ujian Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function hapusGuru($email){
        DB::beginTransaction();
        try {
            UsersModel::where('email',$email)->delete();
            GuruModel::where('email',$email)->delete();
            DB::commit();
            return redirect()->to('admin/guru/?message=Guru Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function editKelas(Request $request){
        DB::beginTransaction();
        try {
            $data = [
                'kelas'=>$request->input('Kelas'),
                'sub_kelas'=>$request->input('SubKelas'),
                'wali_kelas'=>$request->input('WaliKelas')
            ];
            KelasModel::where('id_kelas',$request->input('IDKelas'))->update($data);
            DB::commit();
            return redirect()->to('admin/kelas/?message=Kelas Berhasil Diubah');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function hapusMetodePembayaran($id){
        DB::beginTransaction();
        try {
            BankPembayaranModel::where('id',$id)->delete();
            DB::commit();
            return redirect()->to('admin/pembayaran/?message=Bank Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function hapusPembayaran($id){
        DB::beginTransaction();
        try {
            PembayaranModel::where('pembayaran_id',$id)->delete();
            DB::commit();
            return redirect()->to('admin/pembayaran/?message=Pembayaran Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function activePembayaran($id){
        DB::beginTransaction();
        try {
            PembayaranModel::where('pembayaran_id',$id)->restore();
            DB::commit();
            return redirect()->to('admin/pembayaran/?message=Pembayaran Berhasil Diaktifkan');
        } catch (\Exception $e) {
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

    public function tambahBerita(Request $request){
        $judulBerita = $request->input('judulBerita');
        $pilihKategori = $request->input('pilihKategori');
        $tanggalDibuat = $request->input('tanggalDibuat');
        $beritaIsi = $request->input('quill-html');
        $emailAuthor = $request->input('emailAuthor');
        $nameAuthor = $request->input('nameAuthor');
        $gambarBerita = $request->file('gambarBerita');
        $tampilDiHome = $request->input('tampilHome') == 'on' ? 1 : 0;
        $fileName = Str::random(10).'.'.$gambarBerita->extension();
        // dd($beritaIsi,$judulBerita,$pilihKategori,$tanggalDibuat,$emailAuthor,$nameAuthor, $fileName);

        DB::beginTransaction();
        try {
            $getKategoriName = DB::connection('web-sekolah')->table('tbl_kategori')->where('kategori_id',$pilihKategori)->first();
            $getIdAuthor = UsersModel::where('email',$emailAuthor)->first();
            DB::connection('web-sekolah')->table('tbl_tulisan')->insert([
                'tulisan_judul'=>$judulBerita,
                'tulisan_isi'=>$beritaIsi,
                'tulisan_tanggal'=>$tanggalDibuat,
                'tulisan_kategori_id'=>$pilihKategori,
                'tulisan_kategori_nama'=>$getKategoriName->kategori_nama,
                'tulisan_views'=>0,
                'tulisan_gambar'=>$fileName,
                'tulisan_pengguna_id'=>$getIdAuthor->id,
                'tulisan_author'=>$nameAuthor,
                'tulisan_img_slider'=>$tampilDiHome
            ]);
            $gambarBerita->move('assets/web-sekolah/assets/images/',$fileName);
            DB::commit();
            return redirect()->to('/admin/berita/?message=Berita Berhasil Ditambahkan');
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
            DB::rollBack();
        }
    }

    public function hapusBerita($id){
        DB::beginTransaction();
        try {
            // DB::connection('web-sekolah')->table('tbl_tulisan')->where('tulisan_id',$id)->delete();
            WebSekolahModel::hapus_tulisan($id);
            DB::commit();
            return redirect()->to('/admin/berita/?message=Berita Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function tambahAgenda(Request $request){
        $judulAgenda = $request->input('judulAgenda');
        $agendaMulai = $request->input('agendaMulai');
        $agendaSelesai = $request->input('agendaSelesai');
        $agendaTempat = $request->input('agendaTempat');
        $agendaWaktu = $request->input('agendaWaktu');
        $quillHtmlIsiAgenda = $request->input('quill-html-isiAgenda');
        $quillHtmlAgendaKeterangan = $request->input('quill-html-agendaKeterangan');
        $nameAuthor = $request->input('nameAuthor');
        $currentDate = Carbon::now();
        DB::beginTransaction();
        try {
            DB::connection('web-sekolah')->table('tbl_agenda')->insert([
                'agenda_nama'=>$judulAgenda,
                'agenda_tanggal'=>$currentDate,
                'agenda_deskripsi'=>$quillHtmlIsiAgenda,
                'agenda_mulai'=>$agendaMulai,
                'agenda_selesai'=>$agendaSelesai,
                'agenda_tempat'=>$agendaTempat,
                'agenda_waktu'=>$agendaWaktu,
                'agenda_keterangan'=>$quillHtmlAgendaKeterangan,
                'agenda_author'=>$nameAuthor
            ]);
            DB::commit();
            return redirect()->to('/admin/agenda/?message=Agenda Berhasil Ditambahkan');
        } catch (\Exception $e) {
            //throw $th;
            if(Utils::checkEnvIsLocal()){
                dd($e);
            }
            DB::rollBack();
        }
    }
    public function hapusAgenda($id){
        DB::beginTransaction();
        try {
            // DB::connection('web-sekolah')->table('tbl_tulisan')->where('tulisan_id',$id)->delete();
            WebSekolahModel::hapus_agenda($id);
            DB::commit();
            return redirect()->to('/admin/agenda/?message=Agenda Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function tambahFile(Request $request){
        $judulFile = $request->input('judulFile');
        $fileTanggal = $request->input('fileTanggal');
        $fileOleh = $request->input('fileOleh');
        $fileData = $request->file('fileData');
        $fileDeskripsi = $request->input('fileDeskripsi');

        $fileName = Str::random(10).'.'.$fileData->extension();

        DB::beginTransaction();
        try {
            DB::connection('web-sekolah')->table('tbl_files')->insert([
                'file_judul'=>$judulFile,
                'file_deskripsi'=>$fileDeskripsi,
                'file_tanggal'=>$fileTanggal,
                'file_oleh'=>$fileOleh,
                'file_download'=>0,
                'file_data'=>$fileName
            ]);
            $fileData->move('assets/web-sekolah/assets/files/',$fileName);
            DB::commit();
            return redirect()->to('/admin/files/?message=File Berhasil Ditambahkan');
        } catch (\Exception $e) {
            if(Utils::checkEnvIsLocal()){
                dd($e);
            }
            DB::rollBack();
        }
    }

    public function hapusFile($id){
        DB::beginTransaction();
        try {
            // DB::connection('web-sekolah')->table('tbl_tulisan')->where('tulisan_id',$id)->delete();
            WebSekolahModel::hapus_file($id);
            DB::commit();
            return redirect()->to('/admin/files/?message=File Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function buatAlbum(Request $request){
        $namaAlbum = $request->input('namaAlbum');
        $emailAuthor = $request->input('emailAuthor');
        $nameAuthor = $request->input('nameAuthor');
        $albumCover = $request->file('albumCover');
        $currentDate = Carbon::now();

        $fileName = $request->hasFile('albumCover') ? Str::random(10).'.'.$albumCover->extension() : "";

        // return response()->json(Utils::generateResponseTemplate('OK',200,'Internal Server Error',[$namaAlbum,$emailAuthor,$nameAuthor,$albumCover->extension()]),200);
        DB::beginTransaction();
        try {
            $getIdAuthor = UsersModel::where('email',$emailAuthor)->first();
            DB::connection('web-sekolah')->table('tbl_album')->insert([
                'album_nama'=>$namaAlbum,
                'album_tanggal'=>$currentDate,
                'album_pengguna_id'=>$getIdAuthor->id,
                'album_author'=>$nameAuthor,
                'album_count'=>0,
                'album_cover'=>$fileName
            ]);
            if($fileName != ""){

                $albumCover->move('assets/web-sekolah/assets/images/',$fileName);
            }
            DB::commit();
            return response()->json(Utils::generateResponseTemplate('OK',200,'Album Berhasil Dibuat',null),200);
        } catch (\Exception $e) {
            return response()->json(Utils::generateResponseTemplate('Not OK',500,'Internal Server Error',null),500);
            if(Utils::checkEnvIsLocal()){
                dd($e);
            }
            DB::rollBack();
        }
    }

    public function getAllAlbum(){
        $data = WebSekolahModel::get_all_album();
        return response()->json(Utils::generateResponseTemplate('OK',200,'Get All Album Success',$data),200);
    }

    public function hapusAlbum($id){
        DB::beginTransaction();
        try {
            // DB::connection('web-sekolah')->table('tbl_tulisan')->where('tulisan_id',$id)->delete();
            WebSekolahModel::hapus_album($id);
            DB::commit();
            return redirect()->to('/admin/gallery/?message=Album Berhasil Dihapus');
        } catch (\Exception $e) {
            return redirect()->to('/admin/gallery/?message=Album Gagal Dihapus');
            if(Utils::checkEnvIsLocal()){
                dd($e);
            }
            DB::rollBack();
        }
    }

    public function tambahFotoBaru(Request $request){
        $judulGaleri = $request->input('judulGaleri');
        $emailAuthor = $request->input('emailAuthor');
        $nameAuthor = $request->input('nameAuthor');
        $albumId = $request->input('album');
        $currentDate = Carbon::now();
        $files = $request->file('fotoBaru');
        DB::beginTransaction();
        try {
            $getIdAuthor = UsersModel::where('email',$emailAuthor)->first();
            foreach($files as $file){
                $fileName = Str::random(10).'.'.$file->extension();
                DB::connection('web-sekolah')->table('tbl_galeri')->insert([
                    'galeri_judul'=>$judulGaleri,
                    'galeri_tanggal'=>$currentDate,
                    'galeri_gambar'=>$fileName,
                    'galeri_album_id'=>$albumId,
                    'galeri_pengguna_id'=>$getIdAuthor->id,
                    'galeri_author'=>$nameAuthor

                ]);
                $file->move('assets/web-sekolah/assets/images/',$fileName);
            }
            DB::connection('web-sekolah')->table('tbl_album')->where('album_id',$albumId)->update(['album_count'=>count($files)]);
            DB::commit();
            return redirect()->to('/admin/gallery/?message=File Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getAlbumGalleryById($id){
        $data = WebSekolahModel::get_galeri_by_album_id($id);
        return response()->json(Utils::generateResponseTemplate('OK',200,'Get Album Success',$data),200);
    }
}
