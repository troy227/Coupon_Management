@php
    use Carbon\Carbon;
    $today_date = Carbon::today();
@endphp
@extends('layout.coupon')
<title>Coupon Management System</title>
@section('CouponContent')
    <div class="container">
        <h1 class="text-center my-5" >
            Coupons
        </h1>
        <div class="row justify-content-center">
            <div class="col-md8 offset-md2">
                <div class="card card-default">
                    <div class="card-header">
                        Coupons List
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($coupons as $coupon)
                                <li class="list-group-item">
                                    {{$coupon->name}}
                                        <a href="/coupons/{{$coupon->id}}" class="btn btn-primary btn-sm float-right">View</a>
                                    @if(($today_date->diffInDays($coupon->valid_until))<=0)
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">Coupon Expired</button>
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
