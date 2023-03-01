<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime:d M, Y',
        'replied_at' => 'datetime:d M, Y',
    ];
    public function user_image()
    {
        return $this->hasMany('App\Models\User', 'id', 'user_id')->select('id','image');
    }
}
