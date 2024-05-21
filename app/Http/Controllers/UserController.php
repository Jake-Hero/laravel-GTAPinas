<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Account;
use App\Models\Character;
use App\Models\CharacterPhone;

use App\Models\Faction;
use App\Models\Gang;
use App\Models\FactionRank;
use App\Models\GangRank;

use App\Models\Properties;
use App\Models\Furniture;
use App\Models\Business;
use App\Models\Vehicle;

//use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // POST action for user/settings.php
    public function changeSettings(Request $request)
    {
        //Log::info('changePassword method called'); // Log statement for debugging
        
        $user = Auth::user();

        if ($user->isDemoAccount()) {
            return redirect()->back()->with('error', 'Demo accounts cannot change settings.');
        }

        $request->validate([
            'cur_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Check if the current password matches the user's password
        if (!Hash::check($request->cur_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
    
        // Update user's password with the new password
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        return redirect()->back()->with('success', 'Password changed successfully');
    }

    // user/dashboard.php
    public function index(Character $characters)
    {
        $account = new Account();

        $userId = Auth::id();

        // Fetch characters associated with the user
        $c = $characters->getCharacters($userId);

        // Fetch user account details
        $account = $account->find($userId);
        $username = $account->username;
        $registerdate = $account->registerdate;
        $totalhours = $this->secondsToHMS($characters->calculateTotalHours($userId));
        $donatorrank = getDonatorRank($account->donator);
        $email = $account->email ?? 'Unset';
        $verified = $account->verified ? 'Verified' : 'Not Verified';
        $vip = $account->donator;
        $viptime = $account->donatortime;
        $vip_expiration = ($vip > 0) ? '('.date('m/d/Y h:iA', $viptime).')' : '';

        // Determine the highest slot
        $highest_slot = $c->max('slot');

        // Format hours attribute for each character
        foreach ($c as &$character) {
            $character->hours = $this->secondsToHMS($character->hours);
        }

        return view('user.dashboard', compact('c', 'username', 'registerdate', 'totalhours', 'donatorrank', 'email', 'verified', 'vip', 'viptime', 'vip_expiration'));
    }

    // user/settings.php
    public function settings()
    {
        $user = Auth::user();
        $isDemo = $user->isDemoAccount();
        return view('user.settings', compact('isDemo'));    
    }

    public function create_character(Character $characters, $id)
    {
        return view('user.create_character');
    }

    public function character(Character $characters, $id)
    {
        $character = Character::find($id);
        
        if(empty($character)) {
            abort(404);
        }
        
        $userid = $character->uid;
        $authid = auth()->id();
        
        if($authid != $userid) {
            abort(403);
        }

        $character->hours = $this->secondsToHMS($character->hours);

        $faction = $character->faction->name ?? null;
        $gang = $character->gang->name ?? null;

        $factionRank = FactionRank::where('factionid', $character->faction)->where('rank', $character->rank)->first();
        $gangRank = GangRank::where('gangid', $character->gang)->where('rank', $character->rank)->first();

        $factionRankName = $factionRank->name ?? null;
        $gangRankName = $gangRank->name ?? null;

        $admin = $character->admin;

        $phone = CharacterPhone::find($character->id);
        $number = $phone->phone_number ?? 'No Phone';
        $battery = $phone->phone_battery ?? '0%';
        $load_credits = $phone->phone_load ?? '0';

        return view('user.character', compact('character', 'id', 'userid', 'admin', 'number', 'battery', 'load_credits', 'faction', 'gang', 'factionRankName', 'gangRankName'));
    }

    public function house(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $house = new Properties();
        $furniture = new Furniture();
        $properties = $house->fetchHouses($id);

        $authid = auth()->id();
        
        if($authid != $character->uid) {
            abort(403);
        }

        $furnitures = $furniture->countFurnitures($id);
        return view('user.house', compact('properties', 'character', 'furnitures'));
    }

    public function house_inventory(Request $request)
    {
        $houseid = $request->input('houseid');

        $houseData = Properties::find($houseid);
        $weapons = $houseData->getWeapons();

        return response()->json([
            'html' => view('partials.house_inventory', compact('houseData', 'weapons'))->render()
        ]);
    }

    public function business_inventory(Request $request)
    {
        $bizId = $request->input('bizid');

        $business = Business::find($bizId);
        $products = $business->getProducts();

        return response()->json([
            'html' => view('partials.business_inventory', compact('business', 'products'))->render()
        ]);
    }

    public function vehicle_inventory(Request $request)
    {
        $vehid = $request->input('vehid');

        $vehdata = Vehicle::find($vehid);
        $weapons = $vehdata->getWeapons();

        return response()->json([
            'html' => view('partials.vehicle_inventory', compact('vehdata', 'weapons'))->render()
        ]);
    }

    public function business(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $business = new Business();
        $businesses = $business->fetchBusinesses($id);
        
        $authid = auth()->id();
        
        if($authid != $character->uid) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.business', compact('businesses', 'character'));
    }

    public function vehicle(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $vehicle = new Vehicle();
        $vehicles = $vehicle->fetchVehicles($id);
        
        $authid = auth()->id();
        
        if($authid != $character->uid) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.vehicle', compact('vehicles', 'character'));
    }

    private function secondsToHMS($seconds) {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}
