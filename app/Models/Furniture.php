<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    use HasFactory;

    protected $table = 'furniture';

    // count house furniture.
    public function countFurnitures($id)
    {
        return $this->where('houseid', $id)->count();
    }
}
