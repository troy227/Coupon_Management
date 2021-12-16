<?php

namespace App\Models;

use App\Models\CouponUser;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function redeemed_count($userId)
    {
        $checkUser = CouponUser::all()->where('coupon_id', '=', $this->id)->where('user_id', '=', $userId)->isEmpty();
        if ($checkUser) {
            return 0;
        }
        return CouponUser::all()->where('coupon_id', '=', $this->id)->sum('redeems');
    }

    public function redeemed_count_user($userId)
    {
        return CouponUser::where('coupon_id', '=', $this->id)
            ->where('user_id', '=', $userId)
            ->pluck('redeems');
    }

    public function can_redeem($userId)
    {
        if (str_contains($this->code, (string)$userId) && $this->redeemed_count($userId) < $this->max_redeem) {
                if ($this->redeemed_count_user($userId)->isEmpty())
                {
                    return true;
                }
                elseif ($this->redeemed_count_user($userId)[0] < $this->max_redeem_per_user)
                {
                    return true;
                }
            }
        return false;
    }

    public function redeem($userId)
    {
        if ($this->redeemed_count($userId) == 0) {
            CouponUser::create(['user_id' => $userId, 'coupon_id' => $this->id, 'redeems' => 1]);
        } else {
            $couponRedeems =  CouponUser::where('coupon_id', '=', $this->id)
                ->where('user_id', '=', $userId)
                ->pluck('redeems')[0];
            CouponUser::where('coupon_id', '=', $this->id)
                ->where('user_id', '=', $userId)
                ->update(['redeems' => $couponRedeems+1]);
        }

    }

}
