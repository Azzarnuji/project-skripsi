<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersDetail extends Model
{
    use HasFactory;
    protected $table = 'detail_user';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function Kelas(){
        return $this->hasOne(KelasSiswaModel::class,'email_foreign','email');
    }

}
