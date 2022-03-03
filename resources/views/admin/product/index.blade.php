@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Productes Page</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->category->name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->original_price}}</td>
                            <td>{{$item->selling_price}}</td>
                            <td>
                                <img class="cate-image" src="{{asset('assets/uploads/product/'.$item->image)}}">
                            </td>
                            <td  class="">
                                <a href="{{url('/edit-product/'.$item->id)}}" class="btn btn-primary btn-sm">Edit</a >
                                <a href="{{url('/delete-product/'.$item->id)}}" class="btn btn-danger btn-sm">Delete</a >
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
