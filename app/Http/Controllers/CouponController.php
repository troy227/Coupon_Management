<?php

namespace App\Http\Controllers;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons=Coupon::all();
        return view('index')->with('coupons', $coupons);
    }

    public function create()
    {
        return view('create');
    }

    public function store(CouponRequest $request)
    {
        $request->validated();
        Coupon::create($request->all());
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

    public function edit(Coupon $coupon){
        return view('edit')->with('coupon', $coupon);
    }

    public function update(Coupon $coupon, CouponRequest $request)
    {
        $request->validated();
        Coupon::whereId($coupon->id)->update($request->except(['_token']));
        session()->flash('success', 'Coupon updated successfully.');
        return redirect('/coupons');
    }
}
