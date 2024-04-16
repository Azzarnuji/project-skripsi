<?php

namespace App\Models;

use App\Models\UsersDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UsersModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = ['id'];
    protected $hidden = ['password'];
    public $timestamps = false;

    public function detail(){
        return $this->hasOne(UsersDetail::class, 'email', 'email');
    }
    public function UpcomingPayment(){
        return $this->hasOne(UpcomingPaymentsModel::class, 'email', 'email');
    }
}
