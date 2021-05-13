<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZE_EMPRESA extends Model
{
    use HasFactory;

    protected $table = 'ZE_EMPRESA';
    protected $primaryKey = 'ID_EMP';
    public $timestamps = false;

}
