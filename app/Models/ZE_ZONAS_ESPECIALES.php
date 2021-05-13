<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZE_ZONAS_ESPECIALES extends Model
{
    use HasFactory;

    protected $table = 'ZE_ZONAS_ESPECIALES';
    protected $primaryKey = 'ID_ZE';
    public $timestamps = false;
}
