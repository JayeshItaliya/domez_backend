<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomeDiscounts extends Model
{
    use HasFactory;

    public function dome_discounts(): BelongsTo
    {
        return $this->belongsTo(Domes::class, 'dome_id');
    }
}
