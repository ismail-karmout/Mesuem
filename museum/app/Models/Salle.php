<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'capacity',
     
    ];

    // relation 1:n  table artwork
    public function artworks()
    {
        return $this->hasMany(Artwork::class, 'salle_id', 'id');
    }
    // relation n:n table manifestation
    public function manifestations()
    {
        return $this->belongsToMany(Manifestation::class);
    }
}
