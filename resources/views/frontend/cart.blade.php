    @extends('layouts.front')
    @section('title')
        Welcome to E-shop
    @endsection
    @section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">

            <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a> /
            <a href="{{url('cart')}}">Cart </a>

            </h6>
        </div>
    </div>

    <div class="container my-5">
    <div class="cart shadow cartitems">
        @if($cartitems->count()>0 )
        <div class="card-body">
            @php
                $total=0;
            @endphp
            @foreach($cartitems as $item)
            <div class="row product_data">
            <div class="col-md-2  my-auto">
                <img src="{{asset('assets/uploads/product/'.$item->products->image)}}" height="70px" width="70px" alt="image">
            </div>
            <div class="col-md-3  my-auto">
                <h6>{{$item->products->name}}</h6>
            </div>
            <div class="col-md-2 my-auto">
                <h6>Rs {{$item->products->selling_price}}</h6>
            </div>
            <div class="col-md-3  my-auto">
                <input type="hidden" value="{{$item->products->id}}" class="prod_id">
                @if($item->products->prod_qty > $item->prod_qty)
                <label for="Quantity">Quantity</label>
                <div class="input-group text-center mb-3">
                <button class="input-group-text changeQuantity decrement-btn">-</button>
                <input type="text" name="quantity" value="{{$item->prod_qty}}" class="form-control qty-input">
                <button class="input-group-text changeQuantity increament-btn">+</button>
                </div>
                @else
                <h6>Out of stock</h6>
                @endif
            </div>
            <div class="col-md-2  my-auto">
            <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash" aria-hidden="true"></i>  Remove</button>
            </div>
            </div>
            @php
                $total +=$item->products->selling_price * $item->prod_qty;
            @endphp
            @endforeach
            </div>
            <div class="card-footer py-4">
            <h6>
            Total Price : Rs {{$total}}
            <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proceed to Checkout</a>
            </h6>
            </div>
        @else
        <div class="card-body text-center py-5">
            <h2>Your <i class="fa fa-shopping-cart" aria-hidden="true"> Cart is empty</i></h2>
            <a href="{{url('category')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
        </div>
        @endif
    </div>
    </div>


    @endsection
    @section('scripts')
    <script src="{{ asset('/frontend/js/custom.js')}}" ></script>
    @endsection
