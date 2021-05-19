<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateListopctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listopctions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('type');
            $table->string('label');
        });

        DB::table("listopctions")->insert([
                [ "type" =>'1', "label"=>"Persona natural comerciante", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Empresa unipersonal", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedades por Acciones Simplificadas", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedad Limitada", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedad Colectiva", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedad En Comandita Simple", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedad Anónima", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedad En Comandita por Acciones", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"La Empresa Asociativa de Trabajo", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedades Agrarias de Transformación", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Establecimiento de comerio", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Autónomo", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Cooperativa", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Comunidad de bienes", "created_at"=> Carbon::now() ],
                [ "type" =>'1', "label"=>"Sociedad civil", "created_at"=> Carbon::now() ],
        ],true);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listopctions');
    }
}
