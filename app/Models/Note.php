<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'resultat_id',
        'matiere_id',
        'note',
        'coefficient',
        'note_ponderee'
    ];

    protected $casts = [
        'note' => 'decimal:2',
        'coefficient' => 'integer',
        'note_ponderee' => 'decimal:2'
    ];

    // Relations
    public function resultat()
    {
        return $this->belongsTo(Resultat::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
