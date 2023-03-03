<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id','name');
    }
    public function user_name()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')->select('id','name');
    }
    public function dome_name()
    {
        return $this->hasOne('App\Models\Domes', 'id', 'dome_id')->select('id','name');
    }
    public function field_name()
    {
        return $this->hasOne('App\Models\Field', 'id', 'field_id')->select('id','name');
    }
}
