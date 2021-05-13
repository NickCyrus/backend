<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Models\User;
use Carbon\Carbon;
use Db;
use Auth;

class UsuariosController extends Controller
{

    var $slug     = 'usuarios';
    var $idApp    = 3;
    var $infoApp  = '';
    var $permisos = '';

    function getAccessApp($mode = 'all'){
        $user     = new LoginAdmin();
        $this->permisos = $user->accessModule($this->idApp);
        return (count($this->permisos)) ? $this->permisos : false;
    }

    public function exist($email , $id =''){

        if (!isset($id))
            $modulos = DB::table('users')->where('email',$email)->get();
        else
            $modulos = DB::table('users')->where('email',$email)->where('id','<>',$id)->get();

         return (count($modulos)) ? json_encode(array("rs"=>1)) : json_encode(array("rs"=>0));
    }


    public function getName($id){
        $PerfilName = User::find($id);
        return $PerfilName->name;
    }

    function getOptionMenu(){
         $this->infoApp = DB::table('modulesapps')->where('id', $this->idApp)->get();
    }

    public function index()
    {
        if (!$this->getAccessApp() || $this->permisos[0]->aview == 0) return redirect()->route('errorAccess');
        $this->getOptionMenu();

        $empresaid = Auth::user()->empresaid;

        if ($empresaid){
            $datos = DB::table('users')
                        ->leftJoin('profiles','users.profid','profiles.id')
                        ->leftJoin('ZE_EMPRESA','users.empresaid','ZE_EMPRESA.ID_EMP')
                        ->select('users.*','profiles.profname','ZE_EMPRESA.DESCRIPCION')
                        ->where('empresaid',$empresaid)
                        ->paginate(30);
            }else{
                $datos = DB::table('users')
                            ->leftJoin('profiles','users.profid','profiles.id')
                            ->leftJoin('ZE_EMPRESA','users.empresaid','ZE_EMPRESA.ID_EMP')
                            ->select('users.*','profiles.profname','ZE_EMPRESA.DESCRIPCION')
                            ->paginate(30);
            }
        return view($this->slug.'.index', ['modules'=> $datos , 'infoApp' =>  $this->infoApp[0] , 'permisos'=> $this->permisos[0] , 'empresaSelect' => $empresaid ]  );
    }


    public function create()
    {
        $empresaid = Auth::user()->empresaid;
        if (!$this->getAccessApp() || $this->permisos[0]->anew == 0 || $empresaid != 0 ) return redirect()->route('errorAccess');
        $this->getOptionMenu();
        return view($this->slug.'.create', ['infoApp' =>  $this->infoApp[0] , 'permisos'=> $this->permisos[0] , 'isnew'=>true ] );
    }


    public function store(Request $request)
    {
            if (!$this->getAccessApp() || $this->permisos[0]->anew == 0) return redirect()->route('errorAccess');

            $datos = $request->except('_token');

            $args = [
                        "name"=>$datos['name'],
                        "email"=>$datos['email'],
                        "profid"=>$datos['profid'],
                        "empresaid"=>(isset($datos['ID_EMP'])) ? $datos['ID_EMP'] : '',
                        "password"=>bcrypt($datos['password']),
                        "created_at"=>Carbon::now()
                    ];


            $id = User::insertGetId($args);
            DB::table('permissions')->insert( ['userid'=>$id, 'profid'=>$datos['profid']] );
            UserController::log("Creo el usuario {$datos['name']} {$datos['email']} con ID=>{$id} ",'insert');
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
        $empresaid = Auth::user()->empresaid;
        $datos = User::find($id);
        return view($this->slug.'.edit', ["modules"=>$datos, 'infoApp' =>  $this->infoApp[0] , 'empresaSelect' => $empresaid ] );
    }


    public function update(Request $request, $id)
    {
        if (!$this->getAccessApp() || $this->permisos[0]->aedit == 0 ) return redirect()->route('errorAccess');

        $datos = $request->except('_token');

        $args = [
            "name"=>$datos['name'],
            "email"=>$datos['email'],
            "profid"=>$datos['profid'],
            "empresaid"=>(isset($datos['ID_EMP'])) ? $datos['ID_EMP'] : '',
            "updated_at"=>Carbon::now()
        ];
        if ($datos['password']){
            $args["password"]=bcrypt($datos['password']);
        }

        User::where('id','=',$id)->update($args);
        DB::table('permissions')->where('userid','=',$id)->update(['profid'=>$datos['profid']]);
        UserController::log("Actualizo el usuario ".$this->getName($id)." con ID => {$id}",'update');
        return redirect($this->slug.'/');
    }

    public function destroy($id)
    {
          if (!$this->getAccessApp() || $this->permisos[0]->adelete == 0 ) return redirect()->route('errorAccess');
          UserController::log("Elimino el usuario ".$this->getName($id)." con ID => {$id}",'delete');
          User::destroy($id);
          return redirect($this->slug.'/');
    }


}
