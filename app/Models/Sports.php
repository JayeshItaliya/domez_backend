<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sports extends Model
{
    use HasFactory;
    protected $hidden = [
        'is_available',
        'is_deleted',
        'created_at',
        'updated_at',
    ];
    public function scopeAvailable($query)
    {
        return $query->where('is_available', 1);
    }

    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', 2);
    }
}
