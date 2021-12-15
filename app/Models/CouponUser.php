<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    protected $table = 'coupon_user';
    protected $guarded = [];

    public function coupon()
    {
        return $this->hasMany(Coupon::class, 'coupon_id');
    }

}
