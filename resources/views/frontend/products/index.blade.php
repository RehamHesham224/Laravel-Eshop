@extends('layouts.front')
@section('title')
    products
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
   
        <h6 class="mb-0">
         <a href="{{url('category')}}">Collections </a> / 
        <a href="{{url('view-category/'.$category->slug)}}">{{$category->name}} </a>   
        </h6>
    </div>
</div>
   <div class="py-5">
        <div class="container">
            <div class="row">
                <h2>{{$category->name}}</h2>
                <div class="featured-carousel owl-carousel owl-theme">
                    @foreach($products as $prod)
                     <a href="{{url('category/'. $category->slug . '/' . $prod->slug)}}">
                        <div class="item mb-5">
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
