<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Business extends Model
{
    use HasFactory;

    protected $table = 'business';

    // fetch all the businesses owned by the character.
    public function fetchBusinesses($id)
    {
        return $this->where('owner', $id)
                        ->orderBy('id', 'asc')
                        ->get();
    }

    // Fetch business products and prices
    public function getProducts()
    {
        $products = [];
        $data = $this->fetchBizPrices($this->id);
        $type = $this->type - 1;

        if (!empty($data)) {
            $products_name = [
                ["Portable Radio", "Mobile Phone", "GPS", "Rope", "Lottery Ticket", "Mask", "Simcard", "Prepaid Credit", "Fishing Rod", "Dice", "Baking Soda", "Cigarette", "Lighter", "Fuel Can"],
                ["Portable Radio", "Mobile Phone", "GPS", "Rope", "Lottery Ticket", "Mask", "Simcard", "Prepaid Credit", "Fishing Rod", "Dice", "Baking Soda", "Cigarette", "Lighter", "Fuel Can"],
                null,
                ["Clothe", "Accessories"],
                ["Baseball Bat", "9mm", "Shotgun", "Light Armour"],
                ["Water Bottle", "Soda", "Slice of Pizza", "Large Burger"],
                null,
                ["Water Bottle", "Soda", "Slice of Pizza", "Large Burger"]
            ];

            $product = $products_name[$type];

            foreach ($data as $row) {
                $price = [];
                for ($i = 1; $i <= 20; $i++) {
                    $price[] = $row->{'prices' . $i}; 
                }

                if (isset($product)) {
                    foreach ($product as $pn) {
                        $products[] = ['name' => $pn, 'price' => array_shift($price)];
                    }
                } else {
                    if ($type == 2) {
                        // this could be a dealership so let's fetch the vehicles being sold @ dealership.
                        $vehicles = $this->fetchBizCars($this->id);

                        if (isset($vehicles)) {
                            foreach ($vehicles as $v) {
                                $products[] = ['name' => $v->model, 'price' => $v->price]; 
                            }
                        }
                    }
                }
            }
        }
        return $products;
    }

    public function fetchBizPrices($bid)
    {
        return DB::table('business_prices')->where('bizid', $bid)->get()->toArray();
    }

    public function fetchBizCars($bid)
    {
        return DB::table('dealervehicles')->where('bizid', $bid)->get()->toArray();
    }
}