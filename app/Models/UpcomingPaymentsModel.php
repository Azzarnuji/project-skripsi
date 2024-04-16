<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingPaymentsModel extends Model
{
    use HasFactory;
    protected $table = "upcoming_payments";
    protected $guarded = ['id'];
    public $timestamps = true;

    public function PembayaranTable(){
        return $this->hasOne(PembayaranModel::class, 'pembayaran_id', 'pembayaran_id_foreign');
    }
    public function UsersTable(){
        return $this->hasOne(UsersModel::class, 'email', 'email');
    }
}
