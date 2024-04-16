<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utils;
use App\Models\UjianModel;
use Illuminate\Http\Request;
use App\Models\BankUjianModel;
use App\Http\Controllers\Controller;

class ApiUjianController extends Controller
{
    //
    public function getById($id){
        $data = BankUjianModel::where('ujian_id',$id)->with('Ujian')->get()->all();
        return response()->json(Utils::generateResponseTemplate('OK',200,'Berhasil Mengambil Data',$data));
    }
}
