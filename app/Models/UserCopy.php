<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCopy extends Model
{
    use HasFactory;
    protected $fillable = [
        'sdwEnrollNumber', 'sName', 'idwFingerIndex', 'iPrivilege', 'sPassword', 'sTmpData', 'sEnabled', 'sLastEnrollNumber', 'iFlag', 'iTmpLength', 'fromip', 'toips'
    ];
}
