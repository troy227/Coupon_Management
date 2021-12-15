@extends('layout.coupon')

@section('CouponContent')
    <div class="container">
        <h1 class="text-center my-5">
            {{$coupon->name}}
        </h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        Coupon Code
                    </div>
                    <div class="card-body">
                        {{$coupon->code}}
                    </div>
                    <div class="card-header">
                        Description
                    </div>
                    <div class="card-body">
                        {{$coupon->description}}
                    </div>
                    <div class="card-header">
                        Valid from
                    </div>
                    <div class="card-body">
                        {{$coupon->valid_from}}
                    </div>
                    <div class="card-header">
                        Valid Until
                    </div>
                    <div class="card-body">
                        {{$coupon->valid_until}}
                    </div>
                    <div class="card-header">
                        Coupon Amount
                    </div>
                    <div class="card-body">
                        {{$coupon->amount}}
                    </div>
                    <div class="card-header">
                        Maximum Redeems Available
                    </div>
                    <div class="card-body">
                        {{$coupon->max_redeem}}
                    </div>
                    <div class="card-header">
                        Maximum redeems available per User
                    </div>
                    <div class="card-body">
                        {{$coupon->max_redeem_per_user}}
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        @if (Auth::user()->user_type=='Admin')
                        <div class="col-sm">
                            <form method="post" action="/coupons/{{$coupon->id}}/delete">
                                @csrf
                                <input class="btn btn-danger btn-sm my-4" type="submit" value="DELETE">
                            </form>
                        </div>
                        <div class="col-sm">
                            <a href="/coupons/{{$coupon->id}}/edit" class="btn btn-primary my-4 btn-sm float-right">EDIT</a>
                        </div>
                        @endif
                        <div class="col-sm">
                            <form method="post" action="/coupons/{{$coupon->id}}/redeem">
                                @csrf
                                <input class="btn btn-success btn-sm my-4" type="submit" value="REDEEM" >
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    Created by :
                    <a href="/user/{{$coupon->user()->pluck('id')[0]}}/details">{{$coupon->user()->get()->pluck('name')[0]}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
