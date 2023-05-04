<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Domes extends Model
{
    use HasFactory;
    public function dome_image()
    {
        return $this->hasOne('App\Models\DomeImages', 'dome_id', 'id')->select('*', DB::raw("CONCAT('" . url('storage/app/public/admin/images/domes') . "/', images) AS image"));
    }
    public function dome_images()
    {
        return $this->hasMany('App\Models\DomeImages', 'dome_id', 'id')->select('id', 'dome_id', DB::raw("CONCAT('" . url('storage/app/public/admin/images/domes') . "/', images) AS image"));
    }
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id', 'name', 'email', 'is_available');
    }
    public function sport_price()
    {
        return $this->hasMany('App\Models\SetPrices', 'dome_id', 'id')->where('price_type', 1)->select('sport_id', 'price');
    }
    public function working_hours()
    {
        return $this->hasMany('App\Models\WorkingHours', 'dome_id', 'id')->select('id', 'vendor_id', 'dome_id', 'day', 'open_time', 'close_time');
    }
    public function current_day_wh()
    {
        return $this->hasOne('App\Models\WorkingHours', 'dome_id', 'id')->where('day', date('l'))->select('id', 'vendor_id', 'dome_id', 'day', 'open_time', 'close_time');
    }
}
