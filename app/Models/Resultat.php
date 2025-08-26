<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidat_id',
        'examen_id',
        'serie_id',
        'resultat',
        'moyenne',
        'mention',
        'annee_scolaire',
        'actif'
    ];

    protected $casts = [
        'moyenne' => 'decimal:2',
        'annee_scolaire' => 'integer',
        'actif' => 'boolean'
    ];

    // Relations
    public function candidat()
    {
        return $this->belongsTo(Candidat::class);
    }

    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
