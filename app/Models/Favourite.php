<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favourite extends Model
{
    use HasFactory;
    public function has_league_info(): BelongsTo
    {
        return $this->belongsTo(League::class, 'league_id')->whereDate('end_date', '>=', date('Y-m-d'))->where('is_deleted', 2);
    }
    public function has_dome_info(): BelongsTo
    {
        return $this->belongsTo(Domes::class, 'dome_id')->where('is_deleted', 2);
    }
}
