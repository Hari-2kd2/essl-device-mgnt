<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiometricLog extends Model
{
    use HasFactory;

    protected $table      = "ms_sqls";
    protected $primaryKey = 'primary_id';    
    
    protected $fillable = [
        'primary_id',
        'evtlguid',
        'ID',
        'datetime',
        'punching_time',
        'devuid',
        'devdt',
        'device_name',
        'created_at',
        'updated_at',
    ];
}
