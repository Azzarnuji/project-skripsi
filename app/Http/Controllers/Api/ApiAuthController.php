<?php

namespace App\Http\Controllers\Api;

use App\Data\RoleUser;
use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\MailService;
use App\Models\PPDBModel;
use App\Models\UsersDetail;
use App\Models\UsersModel;
use Ichtrojan\Otp\Otp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class ApiAuthController extends Controller
{
    //
    public function login(Request $request): mixed{
        $email = $request->input('email');
        $password = $request->input('password');

        $checkPPDB = PPDBModel::where('email',$email)->first();
        if(isset($checkPPDB) && $checkPPDB->status == 'active'){
            UsersModel::where('email',$email)->update(['role'=>RoleUser::SISWA]);
            PPDBModel::where('email',$email)->delete();
        }
        $user = UsersModel::where('email',$email)->with('detail')->first();
        if($user && password_verify($password,$user['password'])){
            $data = [
                'profile'=>$user,
            ];
            $data['token'] = Utils::generateToken($data);
            return response()->json(Utils::generateResponseTemplate("success", 200, "Login Success", $data),200);
        }else{
            return response()->json(Utils::generateResponseTemplate("failed", 401, "Username or Password Invalid", null),401);
        }

    }

    public function register(Request $request) : mixed
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $religion = $request->input('religion');
        $gender = $request->input('gender');

        DB::beginTransaction();
        try {
            $dataUsers = [
                'email'=>$email,
                'password'=>password_hash($password,PASSWORD_BCRYPT),
                'role'=>RoleUser::CALON_SISWA
            ];
            $dataDetailUser = [
                'email'=>$email,
                'name'=>$name,
                'phone'=>$phone,
                'address'=>$address,
                'religion'=>$religion,
                'gender'=>$gender

            ];
            UsersModel::create($dataUsers);
            UsersDetail::create($dataDetailUser);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json(Utils::generateResponseTemplate("error", 500, "Register Failed", $e),500);
        }
        return response()->json(Utils::generateResponseTemplate("success", 200, "Register Success", null),200);
    }

    public function sendOtp(Request $request){
        try {
            $checkData = UsersModel::where('email',$request->input('email'))->first();
            if(!$checkData){
                return response()->json(Utils::generateResponseTemplate("failed", 404, "Email Not Found", null),404);
            }
            $generateOTP = (new Otp)->generate($request->input('email'),'numeric','4','10');
            $data = [
                'email'=>$request->input('email'),
                'kode_otp'=>$generateOTP->token,
            ];

            Mail::to($request->input('email'))->send(new MailService($data));
            return response()->json(Utils::generateResponseTemplate("success", 200, "Send OTP Success", null),200);
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function verifyOtp(Request $request){
        $email = $request->input('email');
        $kode_otp = $request->input('otp');
        try {
            $verifyOtp = (new Otp)->validate($email,$kode_otp);
            if($verifyOtp->status == true){
                return response()->json(Utils::generateResponseTemplate("success", 200, "Verify OTP Success", null),200);
            }
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function resetPassword(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        try {
            $checkData = UsersModel::where('email',$email)->first();
            if(!$checkData){
                return response()->json(Utils::generateResponseTemplate("failed", 404, "Email Not Found", null),404);
            }
            $updatePassword = UsersModel::where('email',$email)->update(['password'=>password_hash($password,PASSWORD_BCRYPT)]);
            if($updatePassword){
                return response()->json(Utils::generateResponseTemplate("success", 200, "Reset Password Success", null),200);
            }
        } catch (\Exception $e) {
            //throw $th;
            dd($e);
        }
    }

    public function updateProfile(Request $request){
        $email = $request->input('emailUpdateProfile');
        $alamat = $request->input('alamat');
        $telepon = $request->input('telepon');
        $fotoProfile = $request->file('fotoProfile');

        $fileName = $email.'-'. Carbon::now()->format('Y-m-d_H-i-s').'.'.$fotoProfile->extension();
        $fotoProfile->move('assets/foto-siswa/',$fileName);

        DB::beginTransaction();
        try{
            UsersDetail::where('email',$email)->update([
                'address'=>$alamat,
                'phone'=>$telepon,
                'image'=>$fileName
            ]);
            return redirect()->to('siswa/dashboard/?message=Profile Telah Di Update');
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
        }
    }
}
