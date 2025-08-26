<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cisco extends Model
{
    use HasFactory;

    protected $fillable = [
        'dren_id',
        'nom',
        'code',
        'disponible',
        'actif'
    ];

    protected $casts = [
        'disponible' => 'boolean',
        'actif' => 'boolean'
    ];

    // Relations
    public function dren()
    {
        return $this->belongsTo(Dren::class);
    }

    public function etablissements()
    {
        return $this->hasMany(Etablissement::class);
    }
}
