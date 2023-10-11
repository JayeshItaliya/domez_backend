<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiries extends Model
{
    use HasFactory;
    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', 2);
    }
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id', 'name', 'email', 'phone');
    }
    public function user_info()
    {
        return $this->hasOne('App\Models\User', 'email', 'email')->select('id', 'name');
    }
}
