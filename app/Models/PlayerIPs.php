<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerIPs extends Model
{
    use HasFactory;

    protected $table = 'player_ips';

    protected $fillable = [
        'username', 'ip', 'timestamp'
    ];

    protected function casts(): array
    {
        return [
            'timestamp' => 'datetime',
        ];
    }
}
