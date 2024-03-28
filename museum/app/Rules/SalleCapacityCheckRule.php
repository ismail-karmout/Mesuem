<?php

namespace App\Rules;

use App\Models\Salle;
use Illuminate\Contracts\Validation\Rule;

class SalleCapacityCheckRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $salle = Salle::find($value);
        $artworks = $salle->artworks;
        $artworksCount = $artworks->count();
        if ($artworksCount >= $salle->capacity) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Salle est pleine';
    }
}
