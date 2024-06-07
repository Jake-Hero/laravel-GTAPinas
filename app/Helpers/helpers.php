<?php
use Illuminate\Support\Facades\DB;

if (!function_exists('minutesToDHM')) {
    function secondsToDHMS($seconds) {
        $days = floor($seconds / 86400);  // 86400 seconds in a day
        $hours = floor(($seconds % 86400) / 3600);  // 3600 seconds in an hour
        $minutes = floor(($seconds % 3600) / 60);  // 60 seconds in a minute
        $seconds = $seconds % 60;

        $output = '';
        if ($days > 1) {
            $output .= "$days days";
        } elseif ($days == 1) {
            $output .= "$days day";
        }

        if ($hours > 1) {
            $output .= ($output ? ', ' : '') . "$hours hours";
        } elseif ($hours == 1) {
            $output .= ($output ? ', ' : '') . "$hours hour";
        }

        if ($minutes > 1) {
            $output .= ($output ? ', ' : '') . "$minutes minutes";
        } elseif ($minutes == 1) {
            $output .= ($output ? ', ' : '') . "$minutes minute";
        }

        if ($seconds > 1) {
            $output .= ($output ? ', ' : '') . "$seconds seconds";
        } elseif ($seconds == 1) {
            $output .= ($output ? ', ' : '') . "$seconds second";
        }

        return $output;
    }
}

if (!function_exists('secondsToDHMS')) {
    function secondsToDHMS($seconds) {
        $days = floor($seconds / 86400);
        $hours = floor(($seconds % 86400) / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        $output = '';
        if ($days > 1) {
            $output .= "$days days";
        } elseif ($days == 1) {
            $output .= "$days day";
        }

        if ($hours > 1) {
            $output .= ($output ? ', ' : '') . "$hours hours";
        } elseif ($hours == 1) {
            $output .= ($output ? ', ' : '') . "$hours hour";
        }

        if ($minutes > 1) {
            $output .= ($output ? ', ' : '') . "$minutes minutes";
        } elseif ($minutes == 1) {
            $output .= ($output ? ', ' : '') . "$minutes minute";
        }

        if ($seconds > 1) {
            $output .= ($output ? ', ' : '') . "$seconds seconds";
        } elseif ($seconds == 1) {
            $output .= ($output ? ', ' : '') . "$seconds second";
        }

        return $output;
    }
}

if (!function_exists('getTurfType')) {
    function getTurfType($type) {
        $turf_type = "Unset";

        if(isset($type)) {
            switch($type) {
                case 1: $turf_type = "Crack"; break;
                case 2: $turf_type = "Meth"; break;
                case 3: $turf_type = "Materials"; break;
                case 4: $turf_type = "Money"; break;
            }
        }
        return $turf_type;
    }
}

if (!function_exists('computeAverage')) {
    function computeAverage($array) {
        $average = 0;

        if(is_array($array) && count($array) > 0) {
            $average = collect($array)->avg();
        }

        return $average;
    }
}

if (!function_exists('fetchData')) {
    function fetchData($table, $select_column, $column, $value) {
        $data = null;

        if(isset($table) && isset($select_column) && isset($column) && isset($value)) {
            $result = DB::table($table)
                ->where($column, $value)
                ->select($select_column)
                ->first();

            if ($result) {
                $data = $result->{$select_column};
            }
        }
        return $data;
    }
}

if (!function_exists('countRowsInTableEx')) {
    function countRowsInTableEx($table, $specifier, $value) {
        $count = 0;

        if(isset($table) && isset($specifier) && isset($value)) {
            $count = DB::table($table)
                ->where($specifier, '=', $value)
                ->count();
        }

        return $count;
    }
}

if (!function_exists('countRowsInTable')) {
    function countRowsInTable($table)
    {
        return DB::table($table)->count();
    }
}

if (!function_exists('countRowsInTableGreaterThan')) {
    function countRowsInTableGreaterThan($table, $specifier, $value)
    {
        return DB::table($table)
            ->where($specifier, '>=', $value)
            ->count();
    }
}

if (!function_exists('isRpNickname')) {
    function isRpNickname($nickname) {
        // Define the regular expression pattern
        $regex = "/^[A-Z][a-z]+_[A-Z][a-z]+$/";

        // Check if the regex pattern matches the nickname
        return preg_match($regex, $nickname);
    }    
}

if (!function_exists('getSkinImage')) {
    // fetch skin image based on the given skinID.
    function getSkinImage($skin) {
        // question mark by default.
        $skin_file = asset('assets/pictures/skins/undefined.png');

        if(!empty($skin)) {
            if(($skin >= 0 && $skin <= 311) || ($skin <= 20136 && $skin >= 20123)) {
                // change if a valid skin is detected. scan through the pictures/skins folder.
                $skin_file = asset('assets/pictures/skins/' . $skin . '.png');
            }
        }
        return $skin_file;
    }
}

if (!function_exists('getVehicleImage')) {
    // fetch vehicle image based on the given vehicleID.
    function getVehicleImage($vid) {
        // question mark by default.
        $vehicle_file = asset('assets/pictures/vehicles/undefined.png');

        if(!empty($vid)) {
            if(($vid >= 400) && ($vid <= 611)) {
                // change if a valid vehicle is detected. scan through the pictures/vehicles folder.
                $vehicle_file = asset('assets/pictures/vehicles/Vehicle_' . $vid . '.jpg');
            }
        }
        return $vehicle_file;
    }
}

if (!function_exists('getVehicleName')) {
    // fetch vehicle's model name based on the given modelID.
    function getVehicleName($model) {
        $vehicles = "undefined";

        if(isset($model)) {
            $vehicleNames = array(
                "Landstalker", "Bravura", "Buffalo", "Linerunner", "Perrenial", "Sentinel", "Dumper", "Firetruck", "Trashmaster", "Stretch",
                "Manana", "Infernus", "Voodoo", "Pony", "Mule", "Cheetah", "Ambulance", "Leviathan", "Moonbeam", "Esperanto", "Taxi",
                "Washington", "Bobcat", "Mr Whoopee", "BF Injection", "Hunter", "Premier", "Enforcer", "Securicar", "Banshee", "Predator",
                "Bus", "Rhino", "Barracks", "Hotknife", "Trailer 1", "Previon", "Coach", "Cabbie", "Stallion", "Rumpo", "RC Bandit", "Romero",
                "Packer", "Monster", "Admiral", "Squalo", "Seasparrow", "Pizzaboy", "Tram", "Trailer 2", "Turismo", "Speeder", "Reefer", "Tropic",
                "Flatbed", "Yankee", "Caddy", "Solair", "Berkley's RC Van", "Skimmer", "PCJ-600", "Faggio", "Freeway", "RC Baron", "RC Raider",
                "Glendale", "Oceanic", "Sanchez", "Sparrow", "Patriot", "Quad", "Coastguard", "Dinghy", "Hermes", "Sabre", "Rustler", "ZR-350",
                "Walton", "Regina", "Comet", "BMX", "Burrito", "Camper", "Marquis", "Baggage", "Dozer", "Maverick", "News Chopper", "Rancher",
                "FBI Rancher", "Virgo", "Greenwood", "Jetmax", "Hotring", "Sandking", "Blista Compact", "Police Maverick", "Boxville", "Benson",
                "Mesa", "RC Goblin", "Hotring Racer A", "Hotring Racer B", "Bloodring Banger", "Rancher", "Super GT", "Elegant", "Journey",
                "Bike", "Mountain Bike", "Beagle", "Cropdust", "Stunt", "Tanker", "Roadtrain", "Nebula", "Majestic", "Buccaneer", "Shamal",
                "Hydra", "FCR-900", "NRG-500", "HPV1000", "Cement Truck", "Tow Truck", "Fortune", "Cadrona", "FBI Truck", "Willard", "Forklift",
                "Tractor", "Combine", "Feltzer", "Remington", "Slamvan", "Blade", "Freight", "Streak", "Vortex", "Vincent", "Bullet", "Clover",
                "Sadler", "Firetruck LA", "Hustler", "Intruder", "Primo", "Cargobob", "Tampa", "Sunrise", "Merit", "Utility", "Nevada", "Yosemite",
                "Windsor", "Monster A", "Monster B", "Uranus", "Jester", "Sultan", "Stratum", "Elegy", "Raindance", "RC Tiger", "Flash", "Tahoma",
                "Savanna", "Bandito", "Freight Flat", "Streak Carriage", "Kart", "Mower", "Duneride", "Sweeper", "Broadway", "Tornado", "AT-400",
                "DFT-30", "Huntley", "Stafford", "BF-400", "Newsvan", "Tug", "Trailer 3", "Emperor", "Wayfarer", "Euros", "Hotdog", "Club",
                "Freight Carriage", "Trailer 3", "Andromada", "Dodo", "RC Cam", "Launch", "Police Car (LSPD)", "Police Car (SFPD)",
                "Police Car (LVPD)", "Police Ranger", "Picador", "S.W.A.T. Tank", "Alpha", "Phoenix", "Glendale", "Sadler", "Luggage Trailer A",
                "Luggage Trailer B", "Stair Trailer", "Boxville", "Farm Plow", "Utility Trailer"
            );

            if(isset($vehicleNames[$model - 400])) {
                $vehicles = $vehicleNames[$model - 400];
            }
        }
        return $vehicles;
    }
}

if (!function_exists('getWeaponName')) {
    // fetch weapon's name based on the given ID.
    function getWeaponName($weaponid) {
        $weapon_name = null;

        if(isset($weaponid)) {
            $weapons = array(
                'Fist',
                'Brass Knuckles',
                'Golf Club',
                'Nightstick',
                'Knife',
                'Baseball Bat',
                'Shovel',
                'Pool Cue',
                'Katana',
                'Chainsaw',
                'Purple Dildo',
                'Dildo',
                'Vibrator',
                'Silver Vibrator',
                'Flowers',
                'Cane',
                'Grenade',
                'Tear Gas',
                'Molotov Cocktail',
                null, // 19
                null, // 20
                null, // 21
                '9mm',
                'Silenced 9mm',
                'Desert Eagle',
                'Shotgun',
                'Sawnoff Shotgun',
                'Combat Shotgun',
                'Uzi',
                'MP5',
                'AK-47',
                'M4',
                'Tec-9',
                'Country Rifle',
                'Sniper Rifle',
                'RPG',
                'HS Rocket',
                'Flamethrower',
                'Minigun',
                'Satchel Charge',
                'Detonator',
                'Spraycan',
                'Fire Extinguisher',
                'Camera',
                'Night Vision Goggles',
                'Thermal Goggles',
                'Parachute'
            );

            $weapon_name = $weapons[$weaponid];
        }
        return $weapon_name;
    }
}

if (!function_exists('calculateCharacterAge')) {
    // checks the characyer's proper age. (converted from PAWN language (server's game script) to PHP)
    function calculateCharacterAge($timestamp) {
        $age = null;

        if(isset($timestamp)) {
            //$timestamp = date('Y-m-d', strtotime($timestamp));

            $m = date('m');
            $d = date('d');
            $y = date('Y');

            $month = date('m', strtotime($timestamp));
            $day = date('d', strtotime($timestamp));
            $year = date('Y', strtotime($timestamp));

            $age = ($month >= $m && $day >= $d) ? ($y - $year) : ($y - $year - 1);
        }
        return $age;	
    }
}

if (!function_exists('getBizType')) {
    // fetch business's type
    function getBizType($type) {
        if(isset($type)) {
            $type_name = "undefined";

            switch($type) {
                case 1: $type_name = "Gas Station"; break;
                case 2: $type_name = "Convenience Store"; break;
                case 3: $type_name = "Vehicle Dealership"; break;
                case 4: $type_name = "Clothing Store"; break;
                case 5: $type_name = "Gun Store"; break;
                case 6: $type_name = "Restaurant"; break;
                case 7: $type_name = "Car Autoshop"; break;
                case 8: $type_name = "Bar"; break;
            }
        }
        return $type_name;
    }
}

if (!function_exists('getDonatorRank')) {
    // fetch account's donator rank
    function getDonatorRank($rank) {
        $rank_name = "Not Subscribed";

        if(isset($rank)) {
            switch($rank) {
                case 1: $rank_name = "Silver Donator"; break;
                case 2: $rank_name = "Gold Donator"; break;
                case 3: $rank_name = "Platinum Donator"; break;
            }
        }
        return $rank_name;
    }
}