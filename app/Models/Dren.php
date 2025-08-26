<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dren extends Model
{
    use HasFactory;

    protected $fillable = [
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
    public function ciscos()
    {
        return $this->hasMany(Cisco::class);
    }
}
