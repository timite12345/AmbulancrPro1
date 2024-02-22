<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtbSante extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'adresse',
        'email',
        'tel',
        'estValide',
        'typeEtb',
    ];
}
