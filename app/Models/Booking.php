<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;
    public function user_info()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')->select('id','email',DB::raw("CONCAT('" . url('storage/app/public/admin/images/users') . "/', image) AS user_image"));
    }
}


?>
