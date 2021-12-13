@extends('layout.coupon')
@section('content')
    <h1 class="text-center my-5">Edit Coupon</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item">
                                    {{$error}}
                                </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <form action="/coupons/{{$coupon->id}}/update" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="card-header">
                                Coupon Name
                            </div>
                            <input type="text" class="form-control" name="name" placeholder="Coupon Name"
                                   value="{{$coupon->name}}">
                            <div class="card-header">
                                Coupon Code
                            </div>
                            <input type="text" class="form-control" name="code" placeholder="Coupon Code"
                                   value="{{$coupon->code}}">
                            <div class="card-header">
                                Description
                            </div>
                            <input type="text" class="form-control" name="description" placeholder="Description"
                                   value="{{$coupon->description}}">
                            <div class="card-header">
                                Valid From
                            </div>
                            <input type="text" placeholder="Valid From"
                                   onfocus="(this.type='date')" class="form-control" name="valid_from"
                                   value="{{$coupon->valid_from}}">
                            <div class="card-header">
                                Valid Until
                            </div>
                            <input type="text" placeholder="Valid Until"
                                   onfocus="(this.type='date')" class="form-control" name="valid_until"
                                   value="{{$coupon->valid_until}}">
                            <div class="card-header">
                                Coupon Amount
                            </div>
                            <input type="text" class="form-control" name="amount" placeholder="Coupon Amount"
                                   value="{{$coupon->amount}}">
                            <div class="card-header">
                                Max Redeems
                            </div>
                            <input type="text" class="form-control" name="max_redeem" placeholder="Max Redeem"
                                   value="{{$coupon->max_redeem}}">
                            <div class="card-header">
                                Max Redeem per User
                            </div>
                            <input type="text" class="form-control" name="max_redeem_per_user" placeholder="Max Redeem Per User"
                                   value="{{$coupon->max_redeem_per_user}}">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">
                                    Save Coupon
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
