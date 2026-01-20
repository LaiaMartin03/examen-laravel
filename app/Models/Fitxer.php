<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fitxer extends Model
{
    protected $table = 'fitxers';

    protected $fillable = [
        'nom',
        'path',
    ];
}
