<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;
    protected $fillable = [
        'conferencie_id',
        'salle_id',
        'date',
        'sujet',
    ];

    //user table
    public function conferencier()
    {
        return $this->belongsTo(User::class, 'conferencie_id');
    }

    
}
