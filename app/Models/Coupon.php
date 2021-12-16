<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];

    public function created_by(): User
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    function redeemed_count($userId = null): int{
        // $this->id
        // refer pivot table for answer
        if(is_null($userId)){

        }
    }

    function can_redeem($userId): bool {

    }

    function redeem($userId): void {
        // update values in pivot table

    }


    function is_expired(): bool {

    }
}
