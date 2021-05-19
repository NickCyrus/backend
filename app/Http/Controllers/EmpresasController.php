<?php

namespace App\Http\Controllers;

use App\Models\enterprise;
use Illuminate\Http\Request;
use DB;
use Tools;


class EmpresasController extends Controller{

    var $slug     = 'empresas';
    var $idApp    = 4;
    var $infoApp  = '';
    var $permisos = '';

    function run(){
        $this->getOptionMenu();
        $this->getAccessApp();
    }

    function getAccessApp($mode = 'all'){
        $user     = new LoginAdmin();
        $this->permisos = $user->accessModule($this->idApp);
        return (count($this->permisos)) ? $this->permisos : false;
    }

    function getOptionMenu(){
        $this->infoApp = DB::table('modulesapps')->where('id', $this->idApp)->get();
    }

    public function index(){

        $this->run();

        $datos = enterprise::paginate( Tools::paginacion() );

        return view($this->slug.'.index', ["modules"=>$datos ,
                                           "permisos"=>$this->permisos[0] ,
                                           "buscador"=>'',
                                           "infoApp"=>$this->infoApp[0]]);

    }

    public function create(){
            $this->run();
            $enterprise = new enterprise;
            return view($this->slug.'.create', ["modules"=>$enterprise,"permisos"=>$this->permisos[0] , "infoApp"=>$this->infoApp[0]] );
    }


    public function store(Request $request){

            $request->validate([
                        'rs'=>['required', 'min:5'],
                        'nit'=>['required','unique:enterprises']
            ]);


            $datos = $request->except('_token');
            $id    = enterprise::insertGetId($datos);
            UserController::log("Creo la empresa ".Tools::getInfoTableByIdField('enterprise',$id, 'rs')." con ID => {$id}",'update');
            return $this->index();

    }

    public function show(ZE_EMPRESA $modules){
        //
    }

    public function edit($id){
        $this->getOptionMenu();
        $datos = enterprise::find($id);

        return view($this->slug.'.edit', ["modules"=>$datos, 'infoApp' =>  $this->infoApp[0] ] );
    }

    public function update(Request $request, $id){
        $datos = $request->except(['_token','_method']);

        $request->validate([
            'rs'=>['required', 'min:5'],
            'nit'=>['required','unique:enterprises,nit,'.$id]
        ]);

        enterprise::where('id','=',$id)->update($datos);
        UserController::log("Actualizo la empresa ".Tools::getInfoTableByIdField('enterprise',$id, 'rs')." con ID => {$id}",'update');
        return redirect($this->slug.'/');
    }


    public function destroy($id) {
        UserController::log("Elimino la empresa ".Tools::getInfoTableByIdField('enterprise',$id, 'rs')." con ID => {$id}",'delete');
        enterprise::destroy($id);
        return redirect($this->slug.'/');
    }

    public function buscador(Request $request){


        $this->run();
        DB::enableQueryLog();
        $datos = enterprise::orWhere("nit","like","%{$request->buscador}%")
                    ->orWhere("rs","like","%{$request->buscador}%")
                    ->orWhere("db","like","%{$request->buscador}%")
                    ->orWhere("address","like","%{$request->buscador}%")->paginate( Tools::paginacion() );

        return view($this->slug.'.index', ["modules"=>$datos ,
                                           "permisos"=>$this->permisos[0] ,
                                           "infoApp"=>$this->infoApp[0],
                                           "buscador"=>$request->buscador]);


    }

}
