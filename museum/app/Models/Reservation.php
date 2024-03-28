<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visit_id',
        'tarif'
    ];

    // one with visit
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    // one with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
