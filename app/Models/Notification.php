<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'message',
        'type',
        'date',
        'actif',
        'lu'
    ];

    protected $casts = [
        'date' => 'date',
        'actif' => 'boolean',
        'lu' => 'boolean'
    ];
}
