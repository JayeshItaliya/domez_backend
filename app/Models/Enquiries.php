<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiries extends Model
{
    use HasFactory;
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id', 'name', 'email', 'phone');
    }
}
