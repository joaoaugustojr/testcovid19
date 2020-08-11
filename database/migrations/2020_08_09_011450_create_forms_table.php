<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('fever'); // Febre
            $table->boolean('coryza'); // Coriza
            $table->boolean('stuffy_nose'); // Nariz Entupido
            $table->boolean('tiredness'); // Cansaço
            $table->boolean('cough'); // Tosse
            $table->boolean('headache'); // Dor de Cabeça
            $table->boolean('body_aches'); // Dores no Corpo
            $table->boolean('general_discomfort'); // Mal Estar Geral
            $table->boolean('sore_throat'); // Dor de Garganta
            $table->boolean('dyspnea'); // Dificuldade de Respirar
            $table->boolean('lack_of_taste'); // Falta de Paladar
            $table->boolean('loss_of_smell'); // Falta de Olfato
            $table->boolean('locomotion_difficulty'); // Dificuldade de Locomoção
            $table->boolean('diarrhea'); // Diarreia
            $table->double('result')->nullable(); // Resultado da Consulta
            $table->timestamps();

            // foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
