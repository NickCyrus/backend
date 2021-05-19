<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Tools;

class logsusers extends Controller
{

    var $slug     = 'logsusers';
    var $idApp    = 3;
    var $infoApp  = '';
    var $permisos = '';


    function run(){
        $this->getOptionMenu();
        $this->getAccessApp();
    }

    function getOptionMenu(){
        $this->infoApp = DB::table('modulesapps')->where('id', $this->idApp)->get();
    }

    function getAccessApp($mode = 'all'){
        $user     = new LoginAdmin();
        $this->permisos = $user->accessModule($this->idApp);
        return (count($this->permisos)) ? $this->permisos : false;
    }


    function index()
    {
      $this->run();
      $datos  = DB::table('log_actions')
                ->leftJoin('users','log_actions.userid','users.id')
                ->select("log_actions.*","users.name","users.email")
                ->orderby('id','desc')->paginate(Tools::paginacion());
      return view($this->slug.'.index', ['logact'=> $datos , 'infoApp' =>  $this->infoApp[0] , 'permisos'=> $this->permisos[0] ]  );
    }
}