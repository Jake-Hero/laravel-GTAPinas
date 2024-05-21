<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faction extends Model
{
    use HasFactory;

    protected $table = 'factions';

    protected $fillable = [
        'factionid', 'id', 'name', 'acronym', 'leader', 'type', 'color', 'maxrank', 'bulletin',
        'weapon_0', 'weapon_1', 'weapon_2', 'weapon_3', 'weapon_4', 'weapon_5',
        'weapon_6', 'weapon_7', 'weapon_8', 'weapon_9',
        'ammo_0', 'ammo_1', 'ammo_2', 'ammo_3', 'ammo_4', 'ammo_5',
        'ammo_6', 'ammo_7', 'ammo_8', 'ammo_9',
        'skin_0', 'skin_1', 'skin_2', 'skin_3', 'skin_4', 'skin_5',
        'skin_6', 'skin_7', 'skin_8', 'skin_9',
        'salary_0', 'salary_1', 'salary_2', 'salary_3', 'salary_4', 'salary_5', 'salary_6', 'salary_7',
        'salary_8', 'salary_9', 'salary_10', 'salary_11', 'salary_12', 'salary_13', 'salary_14',
    ];
}
