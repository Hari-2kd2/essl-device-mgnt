<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsslDevice extends Model
{
    use HasFactory;
    protected $primary_key = 'essl_device_id';
    protected $fillable = [
        'ip_address',
        'description',
        'status',
        'device_type'
    ];
}
