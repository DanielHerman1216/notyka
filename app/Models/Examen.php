<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'date',
        'niveau',
        'duree',
        'note_eliminatoire',
        'moyenne_admission',
        'actif'
    ];

    protected $casts = [
        'note_eliminatoire' => 'decimal:1',
        'moyenne_admission' => 'decimal:1',
        'actif' => 'boolean'
    ];

    // Relations
    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function resultats()
    {
        return $this->hasMany(Resultat::class);
    }

    public function mentions()
    {
        return $this->hasMany(Mention::class);
    }
}
