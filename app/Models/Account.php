<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = 'accounts';
    public $timestamps = false;

    protected $fillable = [
        'username', 'password', 'email', 'verified', 'code', 'email_cooldown', 'registered', 'registerdate',
        'ip', 'longip', 'streamer', 'donator', 'donatortime', 'tokens', 'boombox', '9mm_skill', 'silencer_skill',
        'deagle_skill', 'shotgun_skill', 'sawnoff_skill', 'spas_skill', 'uzi_skill', 'mp5_skill', 'ak_skill',
        'm4_skill',
    ];

    protected $hidden = [
        'password',
        'email',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'registerdate' => 'datetime',
            'donatortime' => 'datetime',
        ];
    }

    public function characters()
    {
        return $this->hasMany(Character::class, 'uid', 'id');
    }

    public function isDemoAccount()
    {
        return $this->email === 'sample@renegadecommunity.xyz' || $this->username === 'test_account';
    }
}
