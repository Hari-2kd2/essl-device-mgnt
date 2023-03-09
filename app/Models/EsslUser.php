<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EsslUser extends Model
{
    use HasFactory;
    protected $primary_key = 'essl_user_id';

    protected $fillable = [
        'essl_user_id', 'sdwEnrollNumber', 'sName', 'idwFingerIndex', 'iPrivilege', 'sPassword', 'sTmpData', 'sEnabled', 'sLastEnrollNumber', 'iFlag', 'iTmpLength', 'fromip', 'toip', 'ip'
    ];
}
