<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswaModel extends Model
{
    use HasFactory;
    protected $table = 'kelas_siswa';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function DetailKelas(){
        return $this->hasOne(KelasModel::class,'id_kelas','id_kelas_foreign');
    }
    public function DetailSiswa(){
        return $this->hasMany(UsersDetail::class,'email','email_foreign');
    }
    public function DetailSiswaByKelas(){
        return $this->belongsTo(UsersDetail::class,'email','email_foreign');
    }
}
