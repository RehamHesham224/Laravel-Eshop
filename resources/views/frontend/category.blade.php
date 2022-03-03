@extends('layouts.front')
@section('title')
    category
@endsection
@section('content')
    <div class="container py-5">
        <h1>Categories</h1>
        <div class="row">
                @foreach($category as $cate)
                <div class="col-md-4">
                    <a href="{{url('view-category/'.$cate->slug)}}">
                    <div class="card">
                        <img  style="height:300px; "  src="{{asset('assets/uploads/category/'.$cate->image)}}" alt="category image">
                        <div class="card-body">
                            <h5>{{$cate->name}}</h5>
                            <p>
                                {{$cate->description}}
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
        </div>
    </div>
@endsection
