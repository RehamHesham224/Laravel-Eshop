    @extends('layouts.front')
    @section('title')
        Welcome to E-shop
    @endsection
    @section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">

            <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a> /
            <a href="{{url('wishlist')}}">wishlist </a>

            </h6>
        </div>
    </div>

    <div class="container my-5">
    <div class="cart shadow p-2 wishlistitems ">

        <div class="card-body ">
            {{-- {{$wishlist}} --}}
            @if($wishlist->count()>0 )
            @foreach($wishlist as $item)
            <div class="row product_data">
            <div class="col-md-2  my-auto">
                <img src="{{asset('assets/uploads/product/'.$item->products->image)}}" height="70px" width="70px" alt="image">
            </div>
            <div class="col-md-2  my-auto">
                <h6>{{$item->products->name}}</h6>
            </div>
            <div class="col-md-2 my-auto">
                <h6>Rs {{$item->products->selling_price}}</h6>
            </div>
            <div class="col-md-2  my-auto">
                <input type="hidden" value="{{$item->products->id}}" class="prod_id">
                @if($item->products->prod_qty >= $item->prod_qty)
                <label for="Quantity">Quantity</label>
                <div class="input-group text-center mb-3">
                <button class="input-group-text decrement-btn">-</button>
                <input type="text" name="quantity" value="1" class="form-control qty-input">
                <button class="input-group-text increament-btn">+</button>
                </div>
            @else
                <h6>Out of stock</h6>
                @endif
            </div>
            <div class="col-md-2  my-auto">
                <button class="addToCartBtn btn btn-success btn-sm  delete-wishlist-item"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Add To Cart</button>
            </div>
            <div class="col-md-2  my-auto">
            <button class="delete-wishlist-item btn btn-danger btn-sm delete-wishlist-item"><i class="fa fa-trash" aria-hidden="true"></i>  Remove</button>
            </div>
            </div>
            </div>
            @endforeach
        @else
        <div class="card-body text-center py-5">
            <h2>Your <i class="fa fa-wishlifa-stack" aria-hidden="true">Wishlist is empty</i></h2>
        </div>
        @endif
    </div>
    </div>


    @endsection
    @section('scripts')
    <script src="{{ asset('/frontend/js/custom.js')}}" ></script>
    @endsection
