<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetPrices extends Model
{
    use HasFactory;
    public function dome_name()
    {
        return $this->hasOne('App\Models\Domes', 'id', 'dome_id')->select('id','name');
    }
    public function sport_info()
    {
        return $this->hasOne('App\Models\Sports', 'id', 'sport_id')->select('id', 'name');
    }
}
