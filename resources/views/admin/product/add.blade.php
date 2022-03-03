@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div  class="card-body">
                    <form action="{{url('insert-product')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <select name="cate_id" class="form-select " aria-label=".form-select example">
                                        <option selected>Select a Category</option>
                                        @foreach ($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Slug</label>
                                    <input type="text" name="slug" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Small Description</label>
                                    <textarea name="small_description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Description</label>
                                <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Original Price</label>
                                    <input type="number" name="original_price" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Selling Price</label>
                                    <input  type="number" name="selling_price" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Quantity</label>
                                    <input type="number" name="qty" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tax</label>
                                    <input  type="number" name="tax" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name="status" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Trending</label>
                                    <input  type="checkbox" name="trending">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Meta title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Meta Keyword</label>
                                    <input type="text" name="meta_keywords" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Meta Description</label>
                                    <input type="text" name="meta_description" class="form-control">
                                </div>
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

