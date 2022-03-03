@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
        </div>
        <div  class="card-body">
            <form action="{{url('insert-category')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                    <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Popular</label>
                        <input  type="checkbox" name="popular">
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
                        <input type="text" name="meta_descrip" class="form-control">
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
