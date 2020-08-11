<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'cpf',
        'name',
        'age',
        'whatsapp_number',
        'photo_url'
    ];

    // Mutators

    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->format('d/m/Y H:i:s');
    }

    // Relationships

    
}
