<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'user_id',
        'fever', // Febre
        'coryza', // Coriza
        'stuffy_nose', // Nariz Entupido
        'tiredness', // Cansaço
        'cough', // Tosse
        'headache', // Dor de Cabeça
        'body_aches', // Dores no Corpo
        'general_discomfort', // Mal Estar Geral
        'sore_throat', // Dor de Garganta
        'dyspnea', // Dificuldade de Respirar
        'lack_of_taste', // Falta de Paladar
        'loss_of_smell', // Falta de Olfato
        'locomotion_difficulty', // Dificuldade de Locomoção
        'result' // Resultado da Consulta
    ];

    // Mutators

    // Relationships
}
