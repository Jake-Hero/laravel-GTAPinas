<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gang extends Model
{
    use HasFactory;

    protected $table = 'gangs';

    protected $fillable = [
        'id', 'name', 'leader', 'color', 'bulletin',
        'strike', 'materials', 'pot', 'crack', 'meth', 'cash',
        'skin_0', 'skin_1', 'skin_2', 'skin_3', 'skin_4', 'skin_5',
        'skin_6', 'skin_7', 'skin_8', 'skin_9',
    ];
}
