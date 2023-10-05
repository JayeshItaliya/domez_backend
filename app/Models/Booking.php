<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'type',
        'vendor_id',
        'provider_id ',
        'dome_id',
        'league_id',
        'user_id',
        'sport_id',
        'field_id',
        'booking_id',
        'slots',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'booking_mode',
        'age_discount_amount',
        'fields_discount_amount',
        'sub_total',
        'service_fee',
        'hst',
        'total_amount',
        'paid_amount',
        'due_amount',
        'min_split_amount',
        'refunded_amount',
        'payment_mode',
        'payment_type',
        'payment_status',
        'booking_status',
        'booking_accepted_at',
        'token',
        'players',
        'customer_name',
        'customer_email',
        'customer_mobile',
        'team_name',
        'cancelled_by',
        'cancellation_reason',
        'is_payment_released',
        'is_review_noti_send',
        'created_at',
        'updated_at'
    ];

    public function user_info()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id')->select('id', 'name', 'phone', 'email', 'fcm_token', DB::raw("CONCAT('" . url('storage/app/public/admin/images/users') . "/', image) AS user_image"));
    }
    public function dome_owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'vendor_id')->select('id', 'name');
    }
    public function dome_name()
    {
        return $this->hasOne('App\Models\Domes', 'id', 'dome_id')->select('id', 'name');
    }
    public function league_info()
    {
        return $this->hasOne('App\Models\League', 'id', 'league_id')->select('id', 'name');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'booking_id', 'booking_id')->select('transaction_id', 'amount');
    }
    public function fields_name()
    {
        $field_names = Field::whereIn('id', explode(',', $this->field_id))->get()->pluck('name')->toArray();
        return implode(', ', $field_names);
    }
    public function dome_info(): BelongsTo
    {
        return $this->belongsTo(Domes::class, 'dome_id');
    }
}
