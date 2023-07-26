<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    public function league_info()
    {
        return $this->hasOne('App\Models\League', 'id', 'league_id')->select('id', 'name')->whereDate('end_date', '>=', date('Y-m-d'))->where('is_deleted', 2);
    }
}
