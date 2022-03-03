@extends('layouts.front')
@section('title')
    My Orders
@endsection
@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header  bg-primary ">
                        <h4 class="text-white">My View
                            <a href="{{url('my-orders')}}" class="btn btn-warning text-white float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping Details</h4>
                                <hr>
                                <label>First Name</label>
                                <div class="border">{{$orders->fname}}</div>
                                <label>Last Name</label>
                                <div class="border">{{$orders->lname}}</div>
                                <label>Email</label>
                                <div class="border">{{$orders->email}}</div>
                                <label>Phone</label>
                                <div class="border">{{$orders->phone}}</div>
                                <label>Shopping Address</label>
                                <div class="border">
                                    {{$orders->address1}} , <br>
                                    {{$orders->address2}} , <br>
                                    {{$orders->city}} , <br>
                                    {{$orders->state}} , <br>
                                    {{$orders->country}}
                                </div>
                                <label>Zip Code</label>
                                <div class="border">{{$orders->pincode}}</div>

                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $item)
                                        <tr>

                                            <td>{{$item->products->name}}</td>
                                            <td>{{$item->prod_qty}}</td>
                                            <td>{{$item->price}}</td>
                                            <td><img width="50px" src="{{asset('assets/uploads/product/'.$item->products->image)}}" ></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Grand Total : <span class="float-end">{{$orders->total_price}}</span></h4>
                                <h6 class="px-2">Payment Mode :{{$orders->payment_mode}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
