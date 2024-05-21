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
            $character->hours = $this->secondsToHMS($character->hours);
        }

        return view('highscores.playingtime', compact('data'));
    }

    private function secondsToHMS($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
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
