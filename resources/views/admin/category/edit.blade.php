@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Edit/Update Category</h4>
        </div>
        <div  class="card-body">
            <form action="{{url('update-prod/'.$category->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input value="{{$category->name}}" type="text" name="name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input value="{{$category->slug}}" type="text" name="slug" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                    <textarea name="description" cols="30" rows="10" class="form-control">{{$category->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <input {{$category->status =="1"? 'checked':''}} type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Popular</label>
                        <input {{$category->popular == "1"? 'checked':''}} type="checkbox" name="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Meta title</label>
                        <input value="{{$category->meta_title}}" type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Meta Keyword</label>
                        <input value="{{$category->meta_keywords}}" type="text" name="meta_keywords" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Meta Description</label>
                        <input value="{{$category->meta_descrip}}" type="text" name="meta_descrip" class="form-control">
                    </div>
                    @if($category->image)
                        <img class="cate-image" src="{{asset('assets/uploads/category/'.$category->image)}}" alt="category image">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection
