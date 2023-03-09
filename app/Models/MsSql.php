<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsSql extends Model
{
    use HasFactory;
    protected $fillable = [
        'primary_id', 'evtlguid', 'ip_address', 'ID', 'datetime', 'punching_time', 'status', 'type', 'devuid', 'devdt', 'device_name'
    ];
}
