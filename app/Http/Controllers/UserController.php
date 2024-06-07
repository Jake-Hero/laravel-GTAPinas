<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\VerifyEmail;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\Config;
use App\Models\Account;
use App\Models\PlayerIPs;
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

use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function changeSettings(Request $request)
    {
        $user = Auth::user();
    
        if ($user->isDemoAccount()) {
            Log::info("[changeSettings] Demo accounts");
            return redirect()->back()->with('error', 'Demo accounts cannot change settings.');
        }
    
        $request->validate([
            'cur_password' => ['required'],
            'new_email' => ['nullable', 'email', 'unique:accounts,email,' . $user->id],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);
    
        // Check if the current password matches the user's password
        if (!Hash::check($request->cur_password, $user->password)) {
            //Log::info("[changeSettings] Current password is incorrect");
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
        
        // If the new email is different from the current email, update the email
        if ($request->filled('new_email') && $request->new_email !== $user->email) {
            $user->email = $request->new_email;
            $user->verified = false;
            $user->email_verified_at = null; // Mark email as unverified
    
            $verificationUrl = URL::temporarySignedRoute(
                'mail.verify', now()->addMinutes(20), ['id' => $user->id, 'hash' => sha1($user->email)]
            );
    
            Mail::to($user->email)->send(new VerifyEmail($user->username, $verificationUrl));
    
            //Log::info("[changeSettings] A verification email has been sent to your new email address.");

            // Flash a success message
            Session::flash('email_verification', 'A verification email has been sent to your new email address.');
        }
    
        if ($request->filled('new_password')) {
            // Update user's password with the new password
            $user->password = Hash::make($request->new_password);

            //Log::info("[changeSettings] New password.");
        }
    
        //Log::info("[changeSettings] Save.");
        $user->save();
    
        return redirect()->back()->with('success', 'Settings changed successfully');
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
        $totalhours = secondsToHMS($characters->calculateTotalHours($userId));
        $donatorrank = getDonatorRank($account->donator);
        $email = $account->email ?? 'Unset';
        $verified = "Verified";
        //$verified = $account->verified ? 'Verified' : 'Not Verified';
        $vip = $account->donator;
        $viptime = $account->donatortime;
        $vip_expiration = ($vip > 0) ? '('.date('m/d/Y h:iA', strtotime($viptime)).')' : '';

        // Determine the highest slot
        $highest_slot = $c->max('slot');

        // Format hours attribute for each character
        foreach ($c as &$character) {
            $character->hours = secondsToHMS($character->hours);
        }

        return view('user.index', compact('c', 'username', 'registerdate', 'totalhours', 'donatorrank', 'email', 'verified', 'vip', 'viptime', 'vip_expiration'));
    }

    // user/logged_history.php
    public function logged_history()
    {
        $user = Auth::user();
        $master_name = $user->username;

        $loggedins = PlayerIPs::where('username', $user->username)->orderBy('timestamp', 'desc')->limit(30)->get();
        return view('user.logged_history', compact('master_name', 'loggedins'));    
    }

    // user/settings.php
    public function settings()
    {
        $user = Auth::user();
        $isDemo = $user->isDemoAccount();
        $email = $user->email;
        $verified = $user->verified;

        return view('user.settings', compact('isDemo', 'email', 'verified'));    
    }

    public function create_character($slot)
    {
        $user = Auth::user();

        // Check if the user is a demo account
        if ($user->isDemoAccount()) {
            return redirect()->back()->with('error', 'Demo accounts cannot create characters.');
        }

        /* Check if the user is verified
        if (!$user->verified) {
            return redirect()->back()->with('error', 'You must verify your account to create characters.');
        }*/

        // Check if the user already has a character for the given slot
        $character = Character::where('uid', $user->id)->where('slot', $slot)->first();

        if ($character) {
            // If the character already exists for this slot, redirect back with an error message
            return redirect()->back()->with('error', 'You already have a character in this slot.');
        }

        // Check if it's slot 3 and if user is not VIP Level 3.
        if ($slot == 3 && $user->donator < 3) {
            return redirect()->back()->with('error', 'You must be Donator Level 3 to access slot 3.');
        }

        return view('user.create_character', compact('slot'));
    }

    public function insertCharacter(Request $request)
    {
        $user = Auth::user();
        $config = Config::first();

        $validator = Validator::make($request->all(), [
            'slot' => 'required|integer|min:1|max:3',
            'name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!isRpNickname($value)) {
                        $fail("<strong>" . $value . "</strong> is not a proper roleplay name. (follow the Firstname_Lastname format)");
                    }
                }
            ],
            'skin' => 'required|integer|min:1|max:20136',
            'gender' => 'required|integer|in:1,2',
            'birthday' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (calculateCharacterAge($value) < 18) {
                        $fail("You have set your character to be <strong>" . calculateCharacterAge($value) .  "</strong> years old, Only 18 years old and above is accepted.");
                    }
                }]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check if the user already has a character in this slot
        $existingCharacter = Character::where('uid', $user->id)->where('slot', $request->slot)->first();
        if ($existingCharacter) {
            return response()->json(['error' => 'You already have a character in this slot.'], 422);
        }

        if ($request->slot == 3 && $user->donator < 3) {
            return response()->json(['error' => 'You must be Donator Level 3 to create a character at slot 3.'], 422);
        }

        Character::create([
            'uid' => $user->id,
            'slot' => $request->slot,
            'charname' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'cash' => $config->START_MONEY, // Default starting cash
            'bank' => $config->START_BANK, // Default starting bank
            'last_skin' => $request->skin,
            'last_pos_x' => $config->firstSpawnX, // Default position
            'last_pos_y' => $config->firstSpawnY, // Default position
            'last_pos_z' => $config->firstSpawnZ, // Default position
            'last_pos_a' => $config->firstSpawnA, // Default angle
        ]);

        return response()->json(['success' => 'Character created successfully.'], 201);
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

        $character->hours = secondsToHMS($character->hours);

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
        $furniture = new Furniture();
        $properties = Properties::where('owner', $id)->orderBy('id')->get();

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
        $businesses = Business::where('owner', $id)->orderBy('id')->get();
        
        $authid = auth()->id();
        
        if($authid != $character->uid) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.business', compact('businesses', 'character'));
    }

    public function vehicle(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $vehicles = Vehicle::where('owner', $id)->orderBy('id')->get();
        
        $authid = auth()->id();
        
        if($authid != $character->uid) {
            abort(403, 'Unauthorized action.');
        }

        return view('user.vehicle', compact('vehicles', 'character'));
    }
}
