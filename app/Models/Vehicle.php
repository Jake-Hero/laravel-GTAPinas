<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'id', 'owner', 'faction', 'gang', 'jobid', 'server', 'model',
        'color1', 'color2', 'ticket', 'paintjob', 'health',
        'spawn_x', 'spawn_y', 'spawn_z', 'spawn_a', 'interior', 'world',
        'panels', 'doors', 'lights', 'tires', 'mileage',
        'fuel', 'locked', 'impound', 'impound_price', 'plate', 'platereg', 'platevisible',
        'mod0', 'mod1', 'mod2', 'mod3', 'mod4', 'mod5', 'mod6', 'mod7', 
        'mod8', 'mod9', 'mod10', 'mod11', 'mod12', 'mod13', 'mod14', 
        'weapon_0', 'weapon_1', 'weapon_2', 'weapon_3', 'weapon_4', 
        'ammo_0', 'ammo_1', 'ammo_2', 'ammo_3', 'ammo_4', 
        'premium_access', 'need_drain'
    ];

    // fetch the most commonly/popular vehicle in the game. limit it to $limit;
    public function fetchPopularVehicles($limit)
    {
        return $this->selectRaw('model, COUNT(*) as model_count')
            ->where('owner', '>=', 1)
            ->groupBy('model')
            ->orderByDesc('model_count')
            ->limit($limit)
            ->get();
    }

    // fetch all the vehicles owned by the character.
    public function fetchVehicles($id) {
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
