<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Config;
use App\Models\Character;

use App\Models\Faction;
use App\Models\Gang;
use App\Models\Turf;

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

    // AJAX (characters.php)
    public function fetchCharacters(Request $request)
    {
        $columns = ['id', 'charname', 'owner_name'];
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

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
