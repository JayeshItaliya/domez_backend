<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Domes extends Model
{
    use HasFactory;
    public function scopeNotDeleted($query)
    {
        return $query->where('is_deleted', 2);
    }
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
        return $this->hasMany('App\Models\WorkingHours', 'dome_id', 'id')->select('id', 'vendor_id', 'dome_id', 'day', 'open_time', 'close_time', 'is_closed');
    }
    public function day_working_hours($value)
    {
        $date = Carbon::parse($value);
        $dayname = '';
        if (!is_null($date)) {
            $dayname = strtolower($date->format('l'));
        } else if (Carbon::hasTranslation(strtolower($value), 'en')) {
            $dayname = strtolower($value);
        }
        $data = WorkingHours::where('dome_id', $this->id)->where('day', $dayname != '' ? $dayname : date('l'))->select('id', 'vendor_id', 'dome_id', 'day', 'open_time', 'close_time', 'is_closed')->first();
        return $data;
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'dome_id')->where('is_available', 1)->where('is_deleted', 2);
    }
    public function getTotalFieldsAttribute()
    {
        return $this->fields()->count();
    }
    public function scopeHasFields($query)
    {
        return $query->whereHas('fields');
    }
    public function dome_discounts(): HasMany
    {
        return $this->hasMany(DomeDiscounts::class, 'dome_id');
    }
    public function dome_field_discounts(): HasMany
    {
        return $this->hasMany(DomeFieldDiscounts::class, 'dome_id');
    }
}
