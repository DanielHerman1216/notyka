<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'nom',
        'email',
        'sujet',
        'message',
        'statut',
        'reponse',
        'date',
        'actif'
    ];

    protected $casts = [
        'date' => 'date',
        'actif' => 'boolean'
    ];
}
