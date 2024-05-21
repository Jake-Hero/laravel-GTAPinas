<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;

    protected $table = 'properties';

    // fetch all the houses owned by the character.
    public function fetchHouses($id)
    {
        return $this->where('owner', $id)
                        ->orderBy('id', 'asc')
                        ->get();
    }

    // Add a method to extract weapons from house data
    public function getWeapons()
    {
        $weapons = [];
        for ($i = 0; $i < 5; $i++) {
            $weapon_key = 'weapon_' . $i;
            $ammo_key = 'ammo_' . $i;
            
            if ($this->$weapon_key > 0) {
                $weapons[] = ['weapon' => $this->$weapon_key, 'ammo' => $this->$ammo_key];
            }
        }
        return $weapons;
    }
}
