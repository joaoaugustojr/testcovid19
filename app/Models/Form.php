<?php

namespace App\Models;

use Carbon\Carbon;
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
        'diarrhea', // Diarreia
        'result' // Resultado da Consulta
    ];

    // Mutators

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->format('d/m/Y H:i:s');
    }

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
