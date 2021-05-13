<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Auth;
use DB;

class LoginAdmin extends Controller
{
        public function login(Request $req , UserController $user){

            $datos =  (object)$req->input();

            if ( Auth::attempt(['email' => $datos->userName, 'password' => $datos->passName ])){
                    $req->session()->regenerate();
                    $this->updateLastLoginDate();
                    $user->logAccess($req);
                    return redirect('dashboard');

            }
            return redirect()->route('login')->with(['errorLogin' => 'Error por favor verifique los datos.']);

        }

        public function accessModule($idApp ){
            $idUser  = Auth::User()->id;
            $permisos = DB::table('permissions')
                            ->join('profiles','permissions.profid','profiles.id')
                            ->join('profpermissions','profiles.id','profpermissions.profid')
                            ->join('modulesapps','profpermissions.modappid','modulesapps.id')
                            ->where('userid', $idUser )
                            ->where('aview', 1 )
                            ->where('modulesapps.id', $idApp )
                            ->get();
            return $permisos;
        }

        public function getModulesAccess(){
               $idUser = Auth::User()->id;
               $modulos = DB::table('permissions')
                            ->join('profiles','permissions.profid','profiles.id')
                            ->join('profpermissions','profiles.id','profpermissions.profid')
                            ->join('modulesapps','profpermissions.modappid','modulesapps.id')
                            ->where('userid', $idUser )
                            ->where('aview', 1 )
                            ->get();
              return $modulos;

        }

        public function logout(Request $req , UserController $user) {
            $user->logAccessOut($req);
            Auth::logout();
            return redirect('/login');
        }

        public static function updateLastLoginDate(){
            if (Auth::check()){
                    DB::table('users')->where('id', Auth::User()->id)->update(['updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
             }
        }


}
