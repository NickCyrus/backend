<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ConfigController extends Controller
{
    public function getConfig($key = ''){
        $rs = DB::table('configs')->where('keyconf', $key )->first();
        return $rs;
    }

}
