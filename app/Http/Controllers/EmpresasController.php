<?php

namespace App\Http\Controllers;

use App\Models\ZE_EMPRESA;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use DB;
use Auth;

class EmpresasController extends Controller{

    var $slug     = 'empresas';
    var $idApp    = 4;
    var $infoApp  = '';
    var $permisos = '';

    function getAccessApp($mode = 'all'){
        $user     = new LoginAdmin();
        $this->permisos = $user->accessModule($this->idApp);
        return (count($this->permisos)) ? $this->permisos : false;
    }

    function getOptionMenu(){
        $this->infoApp = DB::table('modulesapps')->where('id', $this->idApp)->get();
    }

    public function getName($id){
        $PerfilName = ZE_EMPRESA::find($id);
        return $PerfilName->DESCRIPCION;
    }

    public function index(){

        if (!$this->getAccessApp() || $this->permisos[0]->aview == 0) return redirect()->route('errorAccess');
        $this->getOptionMenu();

        $empresaid = Auth::user()->empresaid;

        if ($empresaid){
            $sql  = "SELECT ZE_EMPRESA.* ,  users.name
                     FROM ZE_EMPRESA
                     LEFT JOIN  users ON ZE_EMPRESA.USUARIO = CONVERT(varchar, users.id)
                     WHERE ID_EMP = $empresaid";
        }else{

            $sql  = "SELECT ZE_EMPRESA.* ,  users.name
                     FROM ZE_EMPRESA
                     LEFT JOIN  users ON ZE_EMPRESA.USUARIO = CONVERT(varchar, users.id) ";
        }



        $datos = DB::select($sql);
        return view($this->slug.'.index', ['modules'=> $datos , 'infoApp' =>  $this->infoApp[0] , 'permisos'=> $this->permisos[0] , 'empresaSelect'=>$empresaid  ]  );

    }

    public function create(){
        $empresaid = Auth::user()->empresaid;
        if (!$this->getAccessApp() || $this->permisos[0]->anew == 0 || $empresaid) return redirect()->route('errorAccess');
        return view('empresas.create');
    }


    public function store(Request $request){

            if (!$this->getAccessApp() || $this->permisos[0]->anew == 0) return redirect()->route('errorAccess');

            $datos = $request->except('_token');
            $args = [
                "USUARIO"=>Auth::user()->id,
                "F_ACTUAL"=>date("Y-m-d"),
                "PROGRAMA"=>'WEB',
                "DESCRIPCION"=>$request->DESCRIPCION,
                "NIT"=>$request->NIT,
                "F_VALIDEZ"=>$request->F_VALIDEZ,
                "COD_EMP_REL"=>$request->COD_EMP_REL,
            ];

            ZE_EMPRESA::insert($args);
            UserController::log("Creo el registro en ZE_EMPRESA - {$request->DESCRIPCION} ",'insert');
            return redirect($this->slug.'/');
    }

    public function show(ZE_EMPRESA $modules){
        //
    }


    public static function selectEmpresas($empresaID = '' , $required = ''){

        $empresaid = Auth::user()->empresaid;

        if ( $empresaid )
            $empresas = DB::table('ZE_EMPRESA')->where("ID_EMP",'=',$empresaid)->get();
        else
            $empresas = DB::table('ZE_EMPRESA')->get();

        if ($empresas){
            foreach($empresas as $empresa){
                $items[$empresa->ID_EMP] = $empresa->DESCRIPCION;
            }
        }

        return view('component.select',["items" =>$items, "value"=>$empresaID, "nameField"=>'ID_EMP' , 'required'=>$required , 'empresaSelect'=>$empresaid ]);


    }

    public function edit($id){
        if (!$this->getAccessApp() || $this->permisos[0]->aedit == 0 ) return redirect()->route('errorAccess');
        $this->getOptionMenu();
        $datos = ZE_EMPRESA::find($id);
        return view($this->slug.'.edit', ["modules"=>$datos, 'infoApp' =>  $this->infoApp[0] ] );
    }

    public function update(Request $request, $id){

        if (!$this->getAccessApp() || $this->permisos[0]->aedit == 0 ) return redirect()->route('errorAccess');
        $datos = $request->except('_token','_method');
        $args = [
            "USUARIO"=>Auth::user()->id,
            "F_ACTUAL"=>date("Y-m-d"),
            "PROGRAMA"=>'WEB',
            "DESCRIPCION"=>$request->DESCRIPCION,
            "NIT"=>$request->NIT,
            "F_VALIDEZ"=>$request->F_VALIDEZ,
            "COD_EMP_REL"=>$request->COD_EMP_REL,
        ];
        ZE_EMPRESA::where('ID_EMP','=',$id)->update($args);
        UserController::log("Actualizo el registro en ZE_EMPRESA ".$this->getName($id)." con ID => {$id}",'update');
        return redirect($this->slug.'/');
    }


    public function destroy($id) {
          if (!$this->getAccessApp() || $this->permisos[0]->adelete == 0 ) return redirect()->route('errorAccess');
          UserController::log("Elimino el registro en ZE_EMPRESA ".$this->getName($id)." con ID => {$id}",'delete');
          ZE_EMPRESA::destroy($id);
          return redirect($this->slug.'/');
    }

}
