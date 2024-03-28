<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifestation extends Model
{
    use HasFactory;
    protected $fillable = [
        'theme',
        'slug',
        'start_date',
        'end_date',
    ];

    //relations mamny to many with salles
    public function salles()
    {
        return $this->belongsToMany(Salle::class);
    }
}
