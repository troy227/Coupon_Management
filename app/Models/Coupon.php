<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function can_be_redeemed($user_id)
    {
        if (str_contains($this->code, (string)$user_id)) {
            return true;
        }
        return false;
    }
}
