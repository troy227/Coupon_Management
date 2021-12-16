@extends('layout.coupon')
@section('CouponContent')
    <div class="container">
        <h1 class="text-center my-5">
            {{$user->name}}
        </h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-default">
                    @if (Auth::user() -> user_type == 'Admin')
                    <div class="card-header">
                        Coupons Created by {{$user->name}}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($user->getCoupons() as $coupon)
                                <li class="list-group-item">
                                    <b>Name - </b> {{$coupon->name}} ||  <b>Coupon ID</b> {{$coupon->id}}
                                    <a href="/coupons/{{$coupon->id}}" class="btn btn-primary btn-sm float-right">View</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-header">
                        Coupons Redeemed by {{$user->name}}
                    </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($user->redeem()->get() as $coupon)
                                    <li class="list-group-item">
                                        @if($coupon->times_redeemed>0)
                                            <b>Coupon ID</b> {{$coupon->coupon_id}}
                                            <a href="/coupons/{{$coupon->coupon_id}}" class="btn btn-primary btn-sm float-right">View</a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
