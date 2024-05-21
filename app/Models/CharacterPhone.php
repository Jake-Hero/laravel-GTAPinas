<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterPhone extends Model
{
    use HasFactory;

    protected $table = 'character_phone';

    protected $fillable = [
        'id',
        'uid',
        'phone_owner',
        'phone_brand',
        'phone_sim',
        'phone_battery',
        'battery_life',
        'phone_load',
        'phone_number',
    ];
}
