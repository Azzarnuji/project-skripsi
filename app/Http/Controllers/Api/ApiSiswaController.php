<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\KelasSiswaModel;
use App\Models\UpcomingPaymentsModel;
use App\Models\UsersDetail;
use App\Models\UsersModel;

class ApiSiswaController extends Controller
{
    //

    public function bayar(Request $request){
        $email = $request->input('Email');
        $idPembayaran = $request->input('IDPembayaran');
        $rekeningAsal = $request->input('RekeningAsal');
        $namaPemilik = $request->input('NamaPemilikRekeningAsal');
        $buktiPembayaran = $request->file('BuktiPembayaran');


        $fileName = $email.'-'.'bukti-bayar-siswa'.'-'. Carbon::now()->format('Y-m-d_H-i-s').'.'.$buktiPembayaran->extension();
        $buktiPembayaran->move('assets/bukti-pembayaran/',$fileName);
        $data = [
            'rekening_asal'=>$rekeningAsal,
            'nama_pemilik_rekening'=>$namaPemilik,
            'bukti_pembayaran'=>$fileName,
            'status'=>'pending'
        ];
        // dd($data);
        DB::beginTransaction();
        try {
            UpcomingPaymentsModel::where('payment_id',$idPembayaran)->where('email',$email)->update($data);
            DB::commit();
            return redirect()->to('siswa/pembayaran/?message=Pembayaran Dikirim');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function getSiswaByNIS($NIS){
        try {
            $data = UsersDetail::where('nis',$NIS)->first();
            return response()->json(Utils::generateResponseTemplate('OK',200,'Get Data Success',$data),200);
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function daftarSiswaLama(Request $request){
        $FormNIS = $request->input('FormNIS');
        $FormEmail = $request->input('FormEmail');
        $FormPassword = $request->input('FormConfirmPassword');

        DB::beginTransaction();
        try {
            UsersModel::where('email',$FormNIS."@annur.id")->update([
                'email'=>$FormEmail,
                'password'=>password_hash($FormPassword,PASSWORD_DEFAULT)
            ]);
            KelasSiswaModel::where('email_foreign',$FormNIS."@annur.id")->update([
                'email_foreign'=>$FormEmail
            ]);
            UsersDetail::where('email',$FormNIS."@annur.id")->update([
                'email'=>$FormEmail
            ]);

            DB::commit();
            return redirect()->to('siswa/siswaLama/?message=Data Berhasil Diupdate Silahkan Login');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            dd($e);
        }
    }
}

