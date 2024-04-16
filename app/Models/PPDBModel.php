<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDBModel extends Model
{
    use HasFactory;
    protected $table = "ppdb_data";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function DetailUser(){
        return $this->hasOne(UsersDetail::class,'email','email');
    }
}
