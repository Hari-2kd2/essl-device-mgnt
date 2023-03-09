<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessControl extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'essl_device_id', 'essl_user_id', 'status'
    ];


    public function device()
    {
        return $this->hasMany(EsslDevice::class, 'essl_device_id', 'essl_device_id');
    }
    public function user()
    {
        return $this->hasMany(EsslUser::class, 'essl_user_id',  'essl_user_id');
    }
}
