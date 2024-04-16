<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function pembayaran(){
        return $this->hasOne(PembayaranModel::class,'untuk_kelas','kelas');
    }
    public function KelasSiswa(){
        return $this->hasMany(KelasSiswaModel::class,'id_kelas_foreign','id_kelas');
    }

    public function ListSiswa(){
        return $this->hasMany(UsersDetail::class,'id_kelas_foreign','id_kelas');
    }
}
