<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Field extends Model
{
    use HasFactory;
    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }
    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', 2);
    }
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id','name');
    }
    public function dome_name()
    {
        return $this->hasOne('App\Models\Domes', 'id', 'dome_id')->select('id','name');
    }
    public function sport_data()
    {
        return $this->hasOne('App\Models\Sports', 'id', 'sport_id')->select('id','name',DB::raw("CONCAT('" . url('storage/app/public/admin/images/sports') . "/', image) AS image"));
    }
}
