<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model
{
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'nom',
        'note_min',
        'note_max',
        'description',
        'actif'
    ];

    protected $casts = [
        'note_min' => 'decimal:2',
        'note_max' => 'decimal:2',
        'actif' => 'boolean'
    ];

    // Relations
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
