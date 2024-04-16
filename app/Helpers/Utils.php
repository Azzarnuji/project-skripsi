<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Faker\Core\Number;
use App\Models\UsersModel;
use Illuminate\Support\Facades\App;
use UnexpectedValueException;

class Utils {
    public static function generateResponseTemplate(string $status, int $httpCode ,string $message, mixed $data){
        $response = [
            'status' => $status,
            'httpCode' => $httpCode,
            'message' => $message,
            'data' => [
                'items'=>$data
            ]
        ];
        return $response;
    }

    public static function generateToken(mixed $data){
        $getAppKey = env('APP_KEY');
        $sliceKey = rtrim($getAppKey, ':');
        $keyJWT = $sliceKey['1'];
        $generateToken = JWT::encode($data,$keyJWT,'HS256');
        return $generateToken;
    }

    public static function getValueToken(string $token){
        $getAppKey = env('APP_KEY');
        $sliceKey = rtrim($getAppKey, ':');
        $keyJWT = $sliceKey['1'];
        try{
            $decodeToken = JWT::decode($token,new Key($keyJWT,'HS256'));
            return $decodeToken;
        }catch(UnexpectedValueException $e){
            return false;
        }
    }

    public static function convertStdClassToArray(mixed $data){
        return json_decode(json_encode($data), true);
    }

    public static function removeSpecialChar(string $data){
        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $data);
    }

    public static function arrayToString(mixed $data,string $separator = ','){
        return implode($separator, $data);
    }

    public static function currency($nominal){
        $nominal = (int) $nominal;
        return number_format($nominal, 0, ',');
    }

    public static function generateButtonStatus($status){
        switch($status){
            case 'pending':
                return '<button type="button"
                class="btn btn-danger btn-sm">Pending</button>';
                break;
            case 'lunas':
                return '<button type="button"
                class="btn btn-success btn-sm">Lunas</button>';
                break;
            case 'tolak':
                return '<button type="button"
                class="btn btn-danger btn-sm">Ditolak</button>';
                break;
        }
    }

    public static function getNewTokenAndDecodeIt(){
        return Utils::getValueToken(
            Utils::generateToken(
                [
                    'profile'=>
                    UsersModel::where('email',
                        Utils::convertStdClassToArray(
                                Utils::getValueToken($_COOKIE['token'])
                        )['profile']['email']
                    )->with('detail')->first()
                ]
            )
        );
    }

    public static function limit_words($string, $word_limit)
    {
        $words = explode(' ', $string);
        return implode(' ', array_splice($words, 0, $word_limit));
    }

    public static function base_url_web_sekolah(){
        return env('APP_URL').'/assets/web-sekolah/';
    }

    public static function checkEnvIsLocal(){
        return App::environment('local');
    }

    public static function sanitizeLimitString($text){
        return strip_tags(substr($text, 0, 50));
    }
}
