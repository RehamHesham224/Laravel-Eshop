@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Category Page</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td class="text-wrap">{{$item->description}}</td>
                            <td>
                                <img class="cate-image" src="{{asset('assets/uploads/category/'.$item->image)}}">
                            </td>
                            <td>
                                <a href="{{url('/edit-prod/'.$item->id)}}" class="btn btn-primary">Edit</a >
                                <a href="{{url('/delete-prod/'.$item->id)}}" class="btn btn-danger">Delete</a >
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
