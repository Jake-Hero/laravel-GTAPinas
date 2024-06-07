<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;
use App\Models\Account;
use App\Models\Character;
use App\Models\CharacterPhone;

use App\Models\Faction;
use App\Models\Gang;
use App\Models\FactionRank;
use App\Models\GangRank;
use App\Models\Turf;

use App\Models\Properties;
use App\Models\Furniture;
use App\Models\Business;
use App\Models\Vehicle;

class AdminController extends Controller
{
    // admin/dashboard.php
    public function index()
    {
        $config = Config::first();

        return view('admin.index', compact('config'));
    }

    // admin/characters.php
    public function characters()
    {
        return view('admin.characters');
    }

    // admin/character.php?id={$id} (on Vanilla PHP)
    public function character(Character $characters, $id)
    {
        $character = Character::find($id);
        
        if(empty($character)) {
            abort(404);
        }
        
        $userid = $character->uid;

        $character->hours = secondsToDHMS($character->hours);

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

        return view('admin.character', compact('character', 'id', 'userid', 'admin', 'number', 'battery', 'load_credits', 'faction', 'gang', 'factionRankName', 'gangRankName'));
    }

    // admin/turfs.php
    public function turfs()
    {
        $turfs = Turf::all();
        return view('admin.turfs', compact('turfs'));
    }

    // admin/groups.php
    public function groups()
    {
        $factions = Faction::take(20)->get();
        $gangs = Gang::take(20)->get();
        return view('admin.groups', compact('factions', 'gangs'));
    }

    // admin/house.php?id={$id} (on Vanilla PHP)
    public function house(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $furniture = new Furniture();
        $properties = Properties::where('owner', $id)->orderBy('id')->get();

        $furnitures = $furniture->countFurnitures($id);
        return view('admin.house', compact('properties', 'character', 'furnitures'));
    }

    // admin/business.php?id={$id} (on Vanilla PHP)
    public function business(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $businesses = Business::where('owner', $id)->orderBy('id')->get();

        return view('admin.business', compact('businesses', 'character'));
    }

    // admin/vehicle.php?id={$id} (on Vanilla PHP)
    public function vehicle(Character $characters, $id)
    {
        $character = Character::findOrFail($id);
        $vehicles = Vehicle::where('owner', $id)->orderBy('id')->get();

        return view('admin.vehicle', compact('vehicles', 'character'));
    }

    // AJAX (ajax/ajax_house_inventory.php)
    public function house_inventory(Request $request)
    {
        $houseid = $request->input('houseid');

        $houseData = Properties::find($houseid);
        $weapons = $houseData->getWeapons();

        return response()->json([
            'html' => view('partials.house_inventory', compact('houseData', 'weapons'))->render()
        ]);
    }

    // AJAX (ajax/ajax_business_inventory.php)
    public function business_inventory(Request $request)
    {
        $bizId = $request->input('bizid');

        $business = Business::find($bizId);
        $products = $business->getProducts();

        return response()->json([
            'html' => view('partials.business_inventory', compact('business', 'products'))->render()
        ]);
    }

    // AJAX (ajax/ajax_vehicle_inventory.php)
    public function vehicle_inventory(Request $request)
    {
        $vehid = $request->input('vehid');

        $vehdata = Vehicle::find($vehid);
        $weapons = $vehdata->getWeapons();

        return response()->json([
            'html' => view('partials.vehicle_inventory', compact('vehdata', 'weapons'))->render()
        ]);
    }

    // AJAX (ajax/ajax_fetch_characters.php)
    public function fetchCharacters(Request $request)
    {
        $columns = ['id', 'charname', 'owner_name'];
        $limit = $request->input('length', 10); // Default to 10 if not provided
        $start = $request->input('start', 0); // Default to 0 if not provided
        $orderColumnIndex = $request->input('order.0.column', 0); // Default to the first column
        $order = $columns[$orderColumnIndex] ?? 'id'; // Default to 'id' if out of bounds
        $dir = $request->input('order.0.dir', 'asc'); // Default to 'asc' if not provided
    
        $query = Character::select('characters.*', 'accounts.username as owner_name')
            ->leftJoin('accounts', 'characters.uid', '=', 'accounts.id');
    
        $totalData = $query->count();
        $totalFiltered = $totalData;
    
        if (empty($request->input('search.value'))) {
            $characters = $query
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');
    
            $characters = $query
                ->where(function ($q) use ($search) {
                    $q->where('charname', 'LIKE', "%{$search}%")
                        ->orWhere('username', 'LIKE', "%{$search}%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
    
            $totalFiltered = $query
                ->where(function ($q) use ($search) {
                    $q->where('charname', 'LIKE', "%{$search}%")
                        ->orWhere('username', 'LIKE', "%{$search}%");
                })
                ->count();
        }
    
        $data = [];
        foreach ($characters as $character) {
            $nestedData['id'] = $character->id;
            $nestedData['charname'] = $character->charname;
            $nestedData['owner_name'] = $character->owner_name;
    
            $data[] = $nestedData;
        }
    
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        ];
    
        return response()->json($json_data);
    }
}
