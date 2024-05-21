<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GangRank extends Model
{
    use HasFactory;

    protected $table = 'gangranks';

    protected $fillable = [
        'gangid',
        'rank',
        'name',
    ];
}
