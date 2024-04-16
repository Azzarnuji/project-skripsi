<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankUjianModel extends Model
{
    use HasFactory;
    protected $table = 'bank_ujian';
    protected $guarded = ['id'];
    public $timestamps = true;
    public function Ujian(){
        return $this->hasMany(UjianModel::class, 'ujian_id', 'ujian_id');
    }
}
