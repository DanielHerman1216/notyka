<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'nom',
        'description',
        'actif'
    ];

    protected $casts = [
        'actif' => 'boolean'
    ];

    // Relations
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function resultats()
    {
        return $this->hasMany(Resultat::class);
    }
}
