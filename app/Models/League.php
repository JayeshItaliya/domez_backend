<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class League extends Model
{
    use HasFactory;

    public function league_image()
    {
        return $this->hasOne('App\Models\DomeImages', 'league_id', 'id')->select('*', DB::raw("CONCAT('" . url('storage/app/public/admin/images/league') . "/', images) AS image"));
    }
    public function league_images()
    {
        return $this->hasMany('App\Models\DomeImages', 'league_id', 'id')->select('id', 'league_id', DB::raw("CONCAT('" . url('storage/app/public/admin/images/league') . "/', images) AS image"));
    }
    public function dome_info()
    {
        return $this->hasOne('App\Models\Domes', 'id', 'dome_id')->select('id', 'name', 'state', 'city');
    }
}
