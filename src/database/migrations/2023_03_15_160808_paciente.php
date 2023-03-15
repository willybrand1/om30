<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Paciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paciente', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('foto'); 
            $table->string('nome');
            $table->string('mae'); 
            $table->date('nascimento');
            $table->string('cpf');
            $table->string('cns');
        }); 
    }
    //como usar campo data na migration do laravel
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paciente');
    }
}
