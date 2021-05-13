<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZE_TRAFOS extends Model
{
    use HasFactory;

    protected $table = 'ZE_TRAFOS';
    protected $primaryKey = 'ID_TRAFO';
    public $timestamps = false;

}
