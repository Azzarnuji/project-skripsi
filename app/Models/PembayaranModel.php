<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'pembayaran';
    protected $guarded = ['id'];
    public $timestamps = true;
}
