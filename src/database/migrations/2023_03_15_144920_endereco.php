<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Endereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) { 
            $table->increments('id');
            $table->string('cep', 8); 
            $table->string('endereco');
            $table->integer('numero'); 
            $table->string('complemento')->nullable();
            $table->string('bairro'); 
            $table->string('cidade'); 
            $table->char('estado', 2);
            $table->foreignId('paciente_id');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endereco');
    }
}
