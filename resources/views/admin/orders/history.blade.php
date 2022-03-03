@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4>New orders
                        <a href="{{'orders'}}" class="btn btn-warning float-end" >Orders</a>
                    </h4>
                </div>
                <div class="card-body">
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
                            {{-- {{$orders}} --}}
                        @foreach($orders as $item)
                            <tr>
                                <td>{{date('d-m-y', strtotime($item->created_at))}}</td>
                                <td>{{$item->tracking_no}}</td>
                                <td>{{$item->total_price}}</td>
                                <td>{{$item->status == "0" ? "pending" : "completed"}}</td>

                                <td>
                                    <a href="{{url('admin/view-order/'.$item->id)}}" class="btn btn-primary btn-sm">View Order</a >

                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
