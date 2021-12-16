<?php

namespace App\Models;

use App\Models\CouponUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coupon extends Model
{
    protected $guarded = [];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function redeemed_count()
    {
        $checkUser = CouponUser::where('coupon_id', '=', $this->id)->get()->isEmpty();
        if ($checkUser) {
            return 0;
        }
        return CouponUser::where('coupon_id', '=', $this->id)->sum('redeems');
    }

    public function redeemed_count_user($userId)
    {
        return CouponUser::where('coupon_id', '=', $this->id)
            ->where('user_id', '=', $userId)
            ->pluck('redeems');
    }

    public function can_redeem($userId)
    {
        if (str_contains($this->code, (string)$userId) && $this->redeemed_count() < $this->max_redeem) {
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
        if ($this->redeemed_count_user($userId)->isEmpty()) {
            CouponUser::create(['user_id' => $userId, 'coupon_id' => $this->id, 'redeems' => 1]);
        } else {
            CouponUser::where('coupon_id', '=', $this->id)
                ->where('user_id', '=', $userId)
                ->update(['redeems' => DB::raw('redeems+1')]);
        }

    }

}
