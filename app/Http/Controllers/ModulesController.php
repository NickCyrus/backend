<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\modulesapp;
use App\Models\profpermission;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
use Db;

use Illuminate\Http\Request;

class ModulesController extends Controller
{

    var $slug     = 'modules';
    var $idApp    = 1;
    var $infoApp  = '';
    var $permisos = '';

    function getAccessApp($mode = 'all'){
        $user     = new LoginAdmin();
        $this->permisos = $user->accessModule($this->idApp);
        return (count($this->permisos)) ? $this->permisos : false;
    }

    public function getName($id){
        $PerfilName = modulesapp::find($id);
        return $PerfilName->nameapp;
    }


    function getOptionMenu(){
         $this->infoApp = DB::table('modulesapps')->where('id', $this->idApp)->get();
    }

    public function index()
    {
        if (!$this->getAccessApp() || $this->permisos[0]->aview == 0) return redirect()->route('errorAccess');
        $this->getOptionMenu();
        $datos = modulesapp::paginate(30);
        return view($this->slug.'.index', ['modules'=> $datos , 'infoApp' =>  $this->infoApp[0] , 'permisos'=> $this->permisos[0] ]  );
    }


    public function create()
    {
        if (!$this->getAccessApp() || $this->permisos[0]->anew == 0) return redirect()->route('errorAccess');
        $this->getOptionMenu();
        $modulo   = modulesapp::all();
        return view($this->slug.'.create', ['infoApp' =>  $this->infoApp[0] , 'permisos'=> $this->permisos[0] ] );
    }


    public function store(Request $request)
    {
            if (!$this->getAccessApp() || $this->permisos[0]->anew == 0) return redirect()->route('errorAccess');

            $datos = $request->except('_token');
            modulesapp::insert($datos);
            UserController::log("Creo el módulo {$datos['nameapp']} ",'insert');
            return redirect($this->slug.'/');
    }


    public function show(modulesapp $modules)
    {
        //
    }


    public function edit($id)
    {
        if (!$this->getAccessApp() || $this->permisos[0]->aedit == 0 ) return redirect()->route('errorAccess');
        $this->getOptionMenu();
        $datos = modulesapp::find($id);
        return view($this->slug.'.edit', ["modules"=>$datos, 'infoApp' =>  $this->infoApp[0] ] );
    }


    public function update(Request $request, $id)
    {
        if (!$this->getAccessApp() || $this->permisos[0]->aedit == 0 ) return redirect()->route('errorAccess');
        $datos = $request->except('_token','_method');
        modulesapp::where('id','=',$id)->update($datos);
        UserController::log("Actualizo el módulo ".$this->getName($id)." con ID => {$id}",'update');
        return redirect($this->slug.'/');
    }

    public function destroy($id)
    {
          if (!$this->getAccessApp() || $this->permisos[0]->adelete == 0 ) return redirect()->route('errorAccess');
          UserController::log("Elimino el módulo ".$this->getName($id)." con ID => {$id}",'delete');
          modulesapp::destroy($id);
          return redirect($this->slug.'/');
    }
}
