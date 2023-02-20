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
}
