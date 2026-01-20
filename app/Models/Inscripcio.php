<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcio extends Model
{
    protected $table = 'inscripcions';

    protected $fillable = [
        'id_esdeveniment',
        'email',
        'nom',
        'id_fitxer',
    ];

    public function esdeveniment()
    {
        return $this->belongsTo(Esdeveniment::class, 'id_esdeveniment');
    }

    public function fitxer()
    {
        return $this->belongsTo(Fitxer::class, 'id_fitxer');
    }
}