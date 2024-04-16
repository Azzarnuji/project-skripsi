<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianModel extends Model
{
    use HasFactory;
    protected $table = 'bank_soal';
    protected $guarded = ['id'];
    public $timestamps =true;
    public function BankUjian(){
        return $this->hasOne(BankUjianModel::class, 'ujian_id', 'ujian_id');
    }
}
