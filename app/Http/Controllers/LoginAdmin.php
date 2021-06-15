<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Auth;
use DB;
use App\Models\User;
use App\Models\permission;

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
            $idUser  =  Auth::User()->id;
            $permisos = permission::join('ZE_profiles','ZE_permissions.profid','ZE_profiles.id')
                            ->join('ZE_profpermissions','ZE_profiles.id','ZE_profpermissions.profid')
                            ->join('ZE_modulesapps','ZE_profpermissions.modappid','ZE_modulesapps.id')
                            ->where('userid', $idUser )
                            ->where('ZE_modulesapps.id', $idApp )
                            ->get();

            return $permisos;
        }

        static function getModulesAccess(){
               $idUser = Auth::User()->id;
               $modulos = permission::join('ZE_profiles','ZE_permissions.profid','ZE_profiles.id')
                            ->join('ZE_profpermissions','ZE_profiles.id','ZE_profpermissions.profid')
                            ->join('ZE_modulesapps','ZE_profpermissions.modappid','ZE_modulesapps.id')
                            ->where('userid', $idUser )
                            ->get();
              return $modulos;

        }

        static function getModulesAccessMenu(){
            $idUser = Auth::User()->id;
            $modulos = permission::join('ZE_profiles','ZE_permissions.profid','ZE_profiles.id')
                         ->join('ZE_profpermissions','ZE_profiles.id','ZE_profpermissions.profid')
                         ->join('ZE_modulesapps','ZE_profpermissions.modappid','ZE_modulesapps.id')
                         ->where('userid', $idUser )
                         ->where('aview', 1 )
                         ->orderBy('orderapp')
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
                    User::where('id', Auth::User()->id)->update(['updated_at' =>now()]);
             }
        }


}
