    @extends('layouts.front')
    @section('title')
        {{$product->name}}
    @endsection
    @section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="post" action="{{url('/add-rating')}}">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate {{$product->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                {{$user_rating}}
                                @if($user_rating != Null)
                                {{-- @for($i=1; $i<= $user_rating->stars_rated;$i++ )
                                    <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                    <label for="rating1" class="fa fa-star"></label>
                                @endfor
                                @for($j=$user_rating->stars_rated+1; $j<=5 ;$j++ )
                                    <input type="radio" value="{{$i}}"  name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                @endfor --}}

                                @else
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
        </div>
    </div>
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">

            <h6 class="mb-0">
            <a href="{{url('category')}}">Collections </a> /
            <a href="{{url('view-category/'.$product->category->slug)}}">{{$product->category->name}} </a> /
            <a href="{{url('category/'.$product->category->slug .'/' .$product->slug  )}}">{{$product->name}}</a>

            </h6>
        </div>
    </div>

    <div class="py-5">
            <div class="container">
            <div class=" ">
                <div class="">
                <div class="row product_data">
                    <div class="col-md-4 border-right">
                    <img src="{{asset('assets/uploads/product/'.$product->image)}}" class="w-100">
                    </div>
                    <div class="col-md-8">
                    <h2 class="mb-0">
                    {{$product->name}}
                    @if($product->trending =='1')
                    <label style="font-size:16px;" class="float-end badge bg-danger trending_tag">Trending</label>
                        @endif
                    </h2>
                    <label class="me-3"> Original Price : <s>Rs {{$product->original_price}}</s></label>
                    <label class="fw-bold"> Selling Price : Rs {{$product->selling_price}}</label>
                    @php $ratenum= number_format($rating_value) @endphp
                    <div class="rating">
                        @for($i=1; $i<= $ratenum;$i++ )
                            <i class="fa fa-star checked"></i>
                        @endfor
                        @for($j=$ratenum+1; $j<=5 ;$j++ )
                            <i class="fa fa-star"></i>
                        @endfor
                        <span>
                            @if($ratings->count() >0)
                            {{$ratings->count() }} Ratings
                            @else
                            No Rating
                            @endif
                        </span>
                    </div>
                    <p class="mb-3">
                    {{$product->small_description}}
                    </p>
                    @if($product->qty > 0)
                    <label class="badge bg-success">In Stock</label>
                    @else
                        <label class="badge bg-danger">Out of Stock </label>
                    @endif
                    <div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                            <input type="hidden" value="{{$product->id}}" class="prod_id">
                            <label for="Quantity">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" name="quantity" value="1" class="form-control qty-input">
                                <button class="input-group-text increament-btn">+</button>
                            </div>
                            </div>
                            <div class="col-md-8">
                                @if($product->qty > 0)
                                    <button type="button" class="addToCartBtn btn btn-primary me-3 float start">Add to Cart <i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                @endif
                                    <button   button  type="button" class="addToWishlist btn btn-success me-3 float start">Add to Wishlist <i class="fa fa-heart" aria-hidden="true"></i> </button>
                            </div>
                        </div>
                    </div>
                    <hr class=" mt-3">
                    <div class="col-md-12">
                        <h2 >Description</h2>
                        <p>{{$product->description}}</p>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-link " data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate Product
                        </button>
                        <a href="{{url('add-review/'.$product->slug . '/user-review')}}"  class="text-primary text-decoration-underline btn btn-link " >
                            Write a Review
                        </a>
                    </div>
                    <div class="col-md-8">
                        @foreach ($reviews as $item)
                            <div class="user-review">
                                <label for="">{{$item->user->name , " " . $item ->user->lname}}</label>
                                @if ($item->user_id == Auth::id())
                                    <a href="{{ url('edit-review/'.$product->slug .'/user-review') }}" class="btn btn-primary btn-sm text-white">Edit</a>
                                @endif
                                <br>
                                @php
                                    $rating= App\Models\Rating::where('prod_id',$product->id)->where('user_id',$item->user->id)->first();
                                @endphp
                                @if ($rating)
                                    @php
                                        $user_rated =$rating->stars_rated
                                    @endphp
                                    @for($i=1; $i<= $user_rated;$i++ )
                                    <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for($j=$user_rated+1; $j<=5 ;$j++ )
                                        <i class="fa fa-star"></i>
                                    @endfor
                                @endif
                                <br>
                                <small>Reviewd on {{$item->created_at->format('d M Y')}}</small>
                                <p>{{$item->user_review}}</p>
                            </div>
                        @endforeach

                    </div>
                </div>

                </div>
            </div>
            </div>
    @endsection
    @section('scripts')
    <script src="{{ asset('/frontend/js/custom.js')}}" ></script>
    @endsection
