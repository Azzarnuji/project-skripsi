<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utils;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\BankPembayaranModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use App\Models\UpcomingPaymentsModel;

class ApiPembayaranController extends Controller
{
    //
    public function getMetodePembayaran(){
        $getAllMetodePembayaran = BankPembayaranModel::all();
        return response()->json(Utils::generateResponseTemplate('success',200,'Berhasil Mengambil Data',$getAllMetodePembayaran));
    }

    public function bayarPendaftaran(Request $request){
        $rekeningAsal = $request->input('RekeningAsal');
        $namaPemilik = $request->input('NamaPemilikRekeningAsal');
        $email = $request->input('Email');
        $buktiPembayaran = $request->file('BuktiPembayaran');
        $pembayaranIDForeign = $request->input('PembayaranID');

        $fileName = $email.'-'. Carbon::now()->format('Y-m-d_H-i-s').'.'.$buktiPembayaran->extension();
        $buktiPembayaran->move('assets/bukti-pembayaran/',$fileName);
        DB::beginTransaction();
        try {
            $data = [
                'pembayaran_id_foreign'=>$pembayaranIDForeign,
                'payment_id'=>Str::uuid(),
                'email'=>$email,
                'rekening_asal'=>$rekeningAsal,
                'nama_pemilik_rekening'=>$namaPemilik,
                'bukti_pembayaran'=>$fileName,
                'status'=>'pending'
            ];
            UpcomingPaymentsModel::create($data);
            DB::commit();
            return redirect()->to('calon_siswa/dashboard/?message=Pembayaran Dikirim');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
