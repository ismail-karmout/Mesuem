<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    use HasFactory, SoftDeletes;
     


    protected $fillable = [
        'artist_id',
        'salle_id',
        'title',
        'number',
        'description',
        'image',
        'price',
        'origine',
        'assurance_type',
        'security_conditions'
    ];
    // relation with user table
    public function artist()
    {
        return $this->belongsTo(User::class);
    }
    // relation with salle table
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }
}
