<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'config';

    protected $attributes = [
        'START_MONEY' => 1000, // Default starting money
        'START_BANK' => 1000,     // Default starting bank
    ];
}
