<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartUjianModel extends Model
{
    use HasFactory;
    protected $table = 'start_ujian';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function BankUjian(){
        return $this->hasOne(BankUjianModel::class, 'ujian_id', 'ujian_id');
    }
    public function BankSoal(){
        return $this->hasMany(UjianModel::class, 'ujian_id', 'ujian_id');
    }
}
