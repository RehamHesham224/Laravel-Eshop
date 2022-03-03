@extends('layouts.front')
@section('title')
    Edit Review
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-5">
                    <div class="card-body">
                        <h5>You are write a review for product {{$review->product->name}}</h5>
                        <form action="{{url('/update-review')}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="review_id" value="{{$review->id}}">
                            <textarea name="user_review" id="" cols="30" rows="5" class="form-control mb-3" placeholder="Write a Review">{{$review->user_review}}</textarea>
                            <button type="submit" class="btn btn-primary"> Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
