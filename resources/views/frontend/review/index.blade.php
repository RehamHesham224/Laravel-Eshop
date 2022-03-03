@extends('layouts.front')
@section('title')
    {{$product->name}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-5">
                    <div class="card-body">
                        @if ($verified_purchase)
                        <h5>You are Update a review for product {{$product->name}}</h5>
                        <form action="{{url('/add-review')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <textarea name="user_review" id="" cols="30" rows="5" class="form-control mb-3" placeholder="Write a Review"></textarea>
                            <button type="submit" class="btn btn-primary"> Submit Review</button>
                        </form>
                        @else
                        <div class="alert alert-danger">
                            <h5>You are not eligible to review</h5>
                            <p> Only Customer who purshase Order can rate product</p>
                            <a href="{{url('/')}}" class="btn btn-primary text-white">Go to Home page</a>
                        </div>

                        @endif
                        {{$review }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
