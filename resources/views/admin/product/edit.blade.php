@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit/Update Product</h4>
                </div>
                <div  class="card-body">
                    <form action="{{url('update-product/'.$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <select class="form-select " aria-label=".form-select example">
                                    <option selected value="{{$product->category->id}}">{{$product->category->name}}</option>

                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input value="{{$product->name}}" type="text" name="name" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Slug</label>
                                <input value="{{$product->slug}}" type="text" name="slug" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Small Description</label>
                                <textarea  name="small_description" cols="30" rows="10" class="form-control">{{$product->small_description}}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" cols="30" rows="10" class="form-control">{{$product->description}}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Original Price</label>
                                <input value="{{$product->original_price}}" type="number" name="original_price" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Selling Price</label>
                                <input value="{{$product->selling_price}}"  type="number" name="selling_price" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Quantity</label>
                                <input value="{{$product->qty}}" type="number" name="qty" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tax</label>
                                <input  value="{{$product->tax}}" type="number" name="tax" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <input {{$product->status =="1"? 'checked':''}} type="checkbox" name="status">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Popular</label>
                                <input {{$product->popular == "1"? 'checked':''}} type="checkbox" name="popular">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta title</label>
                                <input value="{{$product->meta_title}}" type="text" name="meta_title" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta Keyword</label>
                                <input value="{{$product->meta_keywords}}" type="text" name="meta_keywords" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Meta Description</label>
                                <input value="{{$product->meta_description}}" type="text" name="meta_description" class="form-control">
                            </div>
                            @if($product->image)
                                <img class="cate-image" src="{{asset('assets/uploads/product/'.$product->image)}}" alt="category image">
                            @endif
                            <div class="col-md-12 mb-3">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary" >Update</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
