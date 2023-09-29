<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    // Mutator to set the default timezone for created_at column.
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = $value->setTimezone(env('SET_TIMEZONE'));
    }

    // Mutator to set the default timezone for updated_at column.
    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = $value->setTimezone(env('SET_TIMEZONE'));
    }
}
