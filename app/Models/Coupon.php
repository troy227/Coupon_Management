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

    public function redeem()
    {
        return $this->hasMany(CouponUser::class, 'coupon_id');
    }

    public function can_be_redeemed($user_id): bool
    {
        if (str_contains($this->code, (string)$user_id)) {
            return true;
        }
        return false;
    }
}
