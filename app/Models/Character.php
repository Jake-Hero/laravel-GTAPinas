<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';

    protected $fillable = [
        'uid', 'slot', 'charname', 'creation', 'last_login',
        'level', 'exp', 'hours', 'gender', 'birthday', 'cash',
        'bank', 'last_skin', 'faction', 'gang', 'rank',
    ];

    protected $hidden = [
        'uid',
        'password',
        'email',
    ];

    // fetch all the characters assigned to that account ID.
    public function getCharacters($uid)
    {
        return Character::where('uid', $uid)
                        ->orderBy('slot', 'asc')
                        ->limit(3)
                        ->get();
    }

    // is user admin.
    public function isUserAdmin($uid)
    {
        $characters = $this->getCharacters($uid);

        foreach ($characters as $character) {
            if ($character->admin > 0) {
                return $character->admin;
            }
        }
        return 0;
    }
    
    // fetch a specific data from characters table and then have it rounded up to $limit;
    public function fetchTopCharacterData($column, $limit)
    {
        if (isset($column)) {
            return $this->select($column, 'charname')
                        ->orderBy($column, 'desc')
                        ->limit($limit)
                        ->get();
        }
        return collect(); // Return an empty collection if column is not set
    }

    // fetch the most commonly/popular used skins in the game. limit it to $limit;
    public function fetchPopularSkins($limit)
    {
        return $this->selectRaw('last_skin, COUNT(*) as skin_count')
            ->groupBy('last_skin')
            ->orderByDesc('skin_count')
            ->limit($limit)
            ->get();
    }

    // fetch the wealthiest users in game. limit it to $limit;
    public function fetchWealthyUsers($limit) 
    {
        return $this->selectRaw('(cash + bank) AS total_wealth, charname')
                     ->orderBy('total_wealth', 'desc')
                     ->limit($limit)
                     ->get();
    }

    // calculate all hours played from all the characters from the account.
    public function calculateTotalHours($uid)
    {
        // Initialize hours
        $hours = 0;

        // Fetch character hours for the given user ID
        $characters = $this->where('uid', $uid)->limit(3)->get(['hours']);

        // Calculate total hours
        foreach ($characters as $character) {
            $hours += $character->hours;
        }

        return $hours;
    }

    // fetch skin image based on the given skinID.
    public function getSkinImage($skin) {
        // question mark by default.
        $skin_file = asset('assets/pictures/skins/undefined.png');

        if(!is_null($skin)) {
            if(($skin >= 0 && $skin <= 311) || ($skin <= 20136 && $skin >= 20123)) {
                // change if a valid skin is detected. scan through the pictures/skins folder.
                $skin_file = asset('/assets/pictures/skins/{$skin}.png');
            }
        }
        return $skin_file;
    }
}
