<?php

use App\Http\Controllers\EmpresasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAdmin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\zonasespecialesController;
use App\Http\Controllers\TrafosController;
use App\Http\Controllers\UsuariosController;

Route::get('/login', function () {
    return view('login');
});

Route::get('logout', [LoginAdmin::class,'logout']);

Route::post('/login', [LoginAdmin::class,'login']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/errorAccess',function(){
    return view('accesoinvalido');
})->name('errorAccess');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () { return view('dashboard'); });

    Route::get('dashboard', function () { return view('dashboard'); });

    Route::post('profile', [UserController::class,'updatepass']);
    Route::get('profile', [UserController::class,'view_profile']);

    Route::resource('perfiles', PerfilesController::class);

    Route::resource('usuarios', UsuariosController::class);


    Route::resource('modules', ModulesController::class);
    Route::resource('empresas', EmpresasController::class);
    Route::resource('zonasespeciales', zonasespecialesController::class);

    Route::resource('trafos', TrafosController::class);


    Route::get('tools/showicons', function () { return view('tools.showIcons'); });



    /*Ajax*/

    Route::get('perfiles/exist/{name}/{id?}', [PerfilesController::class,'exist'] );
    Route::get('usuarios/exist/{name}/{id?}', [UsuariosController::class,'exist'] );

});


