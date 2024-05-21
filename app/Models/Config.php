<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $table = 'config';

    protected $fillable = [
        'START_MONEY',
        'START_BANK',
        'TaxRate',
        'OOC_TOGGLE',
        'ADMIN_MOTD',
        'HELPER_MOTD',
        'MOTD',
        'A1_NAME',
        'A2_NAME',
        'A3_NAME',
        'A4_NAME',
        'A5_NAME',
        'A6_NAME',
        'A7_NAME',
        'firstSpawnX',
        'firstSpawnY',
        'firstSpawnZ',
        'firstSpawnA',
        'taxvault',
        'allow_android',
        'vip_chat',
        'global_chat',
        'email_verify',
        'anticheat',
        'highestplayer',
        'highestplayertimestamp',
    ];
}
