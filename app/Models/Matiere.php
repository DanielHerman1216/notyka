<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = [
        'examen_id',
        'serie_id',
        'nom',
        'code',
        'coefficient',
        'actif'
    ];

    protected $casts = [
        'coefficient' => 'integer',
        'actif' => 'boolean'
    ];

    // Relations
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
