<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\CouponUser;
use Illuminate\Http\Request;
use App\Exceptions\CodeInvalidException;
use Illuminate\Support\Facades\DB;

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

    public function store(CouponRequest $request)
    {
        $request->validated();
        $couponId = Coupon::create($request->all() + ['created_by' => $request->user()->id])->id;
        session()->flash('success', 'Coupon created successfully.');
        return redirect('/coupons');
    }

    public function update(Coupon $coupon, CouponRequest $request, CouponUser $couponUser)
    {
        $request->validated();
        Coupon::whereId($coupon->id)->update($request->except(['_token']));
        session()->flash('success', 'Coupon updated successfully.');
        return redirect('/coupons');
    }

    public function redeemCoupon(Coupon $coupon, Request $request)
    {
        if ($coupon->can_redeem($request->user()->id))
        {
            $coupon->redeem($request->user()->id);
            session()->flash('success', 'Coupon redeemed successfully.');
            return redirect('/coupons');
        }
        else
        {
            session()->flash('success', 'You cannot redeem this coupon');
            return redirect('/coupons');
        }
    }
}
