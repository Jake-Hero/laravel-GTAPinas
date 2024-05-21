<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Vehicle;

class HighscoresController extends Controller
{
    public function playingTime(Character $characters)
    {   
        $data = $characters->fetchTopCharacterData('hours', 20);

        // Format hours attribute for each character
        foreach ($data as &$character) {
            $character->hours = secondsToHMS($character->hours);
        }

        return view('highscores.playingtime', compact('data'));
    }

    public function wealthiest(Character $characters)
    {
        $data = $characters->fetchWealthyUsers(20);
        return view('highscores.wealthiest', compact('data'));
    }

    public function skins(Character $characters)
    {
        $data = $characters->fetchPopularSkins(20);
        return view('highscores.skins', compact('data'));
    }

    public function vehiclemodels(Vehicle $vehicles)
    {
        $data = $vehicles->fetchPopularVehicles(20);
        return view('highscores.vehiclemodels', compact('data'));
    }
}
