<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerVehicle extends Model
{
    use HasFactory;

    protected $table = 'dealervehicles';

    protected $fillable = [
        'bizid',
        'model',
        'price'
    ];
}
