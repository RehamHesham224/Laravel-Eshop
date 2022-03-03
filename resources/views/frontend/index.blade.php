@extends('layouts.front')
@section('title')
    Welcome to E-shop
@endsection
@section('content')
    @include('layouts.inc.frontslider')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>Featured Products</h2>
                <div class="featured-carousel owl-carousel owl-theme">
                    @foreach($trending_products as $prod)
                        <div class="item">
                            <div class="card">
                                <img  style="height:200px; "  src="{{asset('assets/uploads/product/'.$prod->image)}}" alt="Product image">
                                <div class="card-body">
                                    <h5>{{$prod->name}}</h5>
                                <div class="d-flex justify-content-between w-100">
                                    <span  >{{$prod->selling_price}} $</span>
                                    <span><s>{{$prod->original_price}} $</s></span>
                                </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                </div>
                {{-- popular category --}}
                <div class="row my-5">
                    <h2>popular category</h2>
                    <div class="featured-carousel owl-carousel owl-theme">
                        @foreach($popular_category as $item)
                            <div class="item">
                            <a href="{{url('view-category/'. $item->slug)}}">
                                <div class="card">
                                    <img  style="height:300px; "  src="{{asset('assets/uploads/category/'.$item->image)}}" alt="category image">
                                    <div class="card-body">
                                        <h5>{{$item->name}}</h5>
                                        <p>
                                            {{$item->description}}
                                        </p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    </div>

            </div>
        </div>
@endsection
@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
            }
        })
    </script>
@endsection
