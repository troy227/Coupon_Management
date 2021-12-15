<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\CouponUser;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return view('index')->with('coupons', $coupons);
    }

    public function create()
    {
        return view('create');
    }

    public function store(CouponRequest $request)
    {
        $request->validated();
        $couponId = Coupon::create($request->all() + ['created_by' => $request->user()->id])->id;
        $couponUser = new CouponUser();
        preg_match_all('!\d+!', $request['code'], $assignedUsers);
        foreach ($assignedUsers[0] as $usersId) {
            $couponUser->user_id = $usersId;
            $couponUser->coupon_id = $couponId;
            $couponUser->redeems = $request['max_redeem_per_user'];
            $couponUser->times_redeemed = 0;
            $couponUser->save();
        }
        session()->flash('success', 'Coupon created successfully.');
        return redirect('/coupons');
    }

    public function show(Coupon $coupon)
    {
        return view('show')->with('coupon', $coupon);
    }

    public function delete(Coupon $coupon)
    {
        $coupon->delete();
        session()->flash('success', 'Coupon deleted successfully.');
        return redirect('/coupons');
    }

    public function edit(Coupon $coupon)
    {
        return view('edit')->with('coupon', $coupon);
    }

    public function update(Coupon $coupon, CouponRequest $request, CouponUser $couponUser)
    {
        $request->validated();
        Coupon::whereId($coupon->id)->update($request->except(['_token']));
        preg_match_all('!\d+!', $request['code'], $assignedUsers);
        CouponUser::where('user_id', '=', $request->user()->id)
            ->update(['redeems' => $request['max_redeem_per_user'], 'times_redeemed' => 0]);
        session()->flash('success', 'Coupon updated successfully.');
        return redirect('/coupons');
    }

    public function redeem(Coupon $coupon, Request $request, CouponUser $couponUser)
    {
        if (!$coupon->can_be_redeemed($request->user()->id)) {
            session()->flash('success', 'You cannot redeem this coupon');
            return redirect('/coupons');
        }
        if ($coupon->max_redeem == 0) {
            session()->flash('success', 'The coupon has been redeemed max number of times');
            return redirect('/coupons');
        } elseif ($request->user()->redeem()->pluck('redeems')[0] <= 0) {
            session()->flash('success', 'You have already redeemed this coupon max number of times');
            return redirect('/coupons');
        } else {
            $coupon->max_redeem -= 1;
            $coupon->save();
            $redeems = $coupon->redeem()->pluck('redeems')[0] - 1;
            $redeemed = $coupon->redeem()->pluck('times_redeemed')[0] + 1;
            CouponUser::where('user_id', '=', $request->user()->id)->where('coupon_id', '=', $coupon->id)
                ->update(['redeems' => $redeems, 'times_redeemed' => $redeemed]);
            session()->flash('success', 'Coupon redeemed successfully.');
            return redirect('/coupons');
        }
    }
}
