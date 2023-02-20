<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    public function vendor_name()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id','name');
    }
    public function dome_name()
    {
        return $this->hasOne('App\Models\Domes', 'id', 'dome_id')->select('id','name');
    }
    public function category_name()
    {
        return $this->hasOne('App\Models\Sports', 'id', 'sport_id')->select('id','name');
    }
}
