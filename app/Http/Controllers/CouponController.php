<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'valid_from' => 'required|before:valid_until|date|date_format:Y-m-d',
            'valid_until' => 'required|after:valid_from|date|date_format:Y-m-d',
            'amount' => 'required|integer|gt:0',
            'max_redeem' => 'required|gte:max_redeem_per_user|integer|gt:0',
            'max_redeem_per_user' => 'required|lte:max_redeem|integer|gt:0'
        ]);
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
}
