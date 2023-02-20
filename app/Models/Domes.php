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
        return $this->hasOne('App\Models\DomeImages', 'dome_id', 'id')->select('*', DB::raw("CONCAT('" . url('storage/app/public/new_admin/images/domes') . "/', images) AS image"));
    }
    public function dome_images()
    {
        return $this->hasMany('App\Models\DomeImages', 'dome_id','id')->select('id','dome_id', DB::raw("CONCAT('" . url('storage/app/public/new_admin/images/domes') . "/', images) AS image"));
    }
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id','name');
    }
}
