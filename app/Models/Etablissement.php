<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'cisco_id',
        'nom',
        'code',
        'type',
        'adresse',
        'telephone',
        'actif'
    ];

    protected $casts = [
        'actif' => 'boolean'
    ];

    // Relations
    public function cisco()
    {
        return $this->belongsTo(Cisco::class);
    }

    public function candidats()
    {
        return $this->hasMany(Candidat::class);
    }

    public function resultats()
    {
        // Relation via les candidats de l'établissement
        return \App\Models\Resultat::whereIn('candidat_id', $this->candidats()->pluck('id'));
    }
}