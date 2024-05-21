<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPrice extends Model
{
    use HasFactory;

    protected $table = 'business_prices';

    protected $fillable = [
        'bizid',
        'prices1', 'prices2', 'prices3', 'prices4', 'prices5',
        'prices6', 'prices7', 'prices8', 'prices9', 'prices10',
        'prices11', 'prices12', 'prices13', 'prices14', 'prices15',
        'prices16', 'prices17', 'prices18', 'prices19', 'prices20'
    ];
}
