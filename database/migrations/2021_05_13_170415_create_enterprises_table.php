<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ZE_enterprises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('rs')->nullable();
            $table->string('nit')->unique();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('dept')->nullable();
            $table->string('address')->nullable();
            $table->string('activity')->nullable();
            $table->integer('forjur')->nullable();
            $table->string('db')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ZE_enterprises');
    }
}
