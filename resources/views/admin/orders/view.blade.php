@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4>orders Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping Details</h4>
                                <hr>
                                <label>First Name</label>
                                <div class="border p-2">{{$order->fname}}</div>
                                <label>Last Name</label>
                                <div class="border p-2">{{$order->lname}}</div>
                                <label>Email</label>
                                <div class="border p-2">{{$order->email}}</div>
                                <label>Phone</label>
                                <div class="border p-2">{{$order->phone}}</div>
                                <label>Shopping Address</label>
                                <div class="border p-2">
                                    {{$order->address1}} , <br>
                                    {{$order->address2}} , <br>
                                    {{$order->city}} , <br>
                                    {{$order->state}} , <br>
                                    {{$order->country}}
                                </div>
                                <label>Zip Code</label>
                                <div class="border p-2">{{$order->pincode}}</div>

                            </div>
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{-- {{$order->orderItems}} --}}
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{$item->products->name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->price}}</td>
                                    <td><img width="50px" src="{{asset('assets/uploads/product/'.$item->products->image)}}" ></td>


                                </tr>
                            @endforeach

                            </tbody>


                        </table>
                        <h4 class="px-2">Grand Total : <span class="float-end">{{$order->total_price}}</span></h4>
                        <label for="">Order Status</label>
                        <form action="{{url('update-order/' . $order->id)}}" method="POST" class="p-2">
                            @csrf
                            {{-- @method('PUT') --}}
                            <select class="form-select py-2 px-5" name="order_status">
                                <option selected>Open this select menu</option>
                                <option {{$order->status =="0" ? 'selected':'' }} value="0">Pending</option>
                                <option {{$order->status =="1" ? 'selected':'' }} value="1">Completed</option>

                              </select>
                              <button type="submit" class="btn btn-info mt-3 float-end">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
