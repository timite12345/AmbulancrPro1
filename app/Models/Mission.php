<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'heureDeb',
        'heureFin',
        'commentaire',
        'chauffeurP',
        'chauffeurS',
        'vehicule',
        'demande',
        'estFacturer',
        'prix'
    ];
}
