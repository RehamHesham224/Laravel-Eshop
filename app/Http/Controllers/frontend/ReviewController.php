<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function add($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', '0')->first();
        if ($product) {
            $product_id = $product->id;
            $review = Review::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
            if ($review) {
                return view('frontend.review.edit', compact('review'));
            } else {
                $verified_purchase = Order::where('orders.user_id', Auth::id())
                    ->join('order_items', 'orders.id', 'order_items.order_id')
                    ->where('order_items.prod_id', $product_id)->get();
            }
            //if user sell this product
            if ($verified_purchase->count() > 0) {
                return view('frontend.review.index', compact('product', 'review', 'verified_purchase'));
            } else {
                return redirect()->back()->with('status', "the link is brockennn");
            }
        }
    }
    public function create(Request $request)
    {
        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)->first();
        if ($product) {
            $user_review = $request->input('user_review');

            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' => $user_review,
            ]);
            $category_slug = $product->Category->slug;
            $prod_slug = $product->slug;
            if ($new_review) {

                return redirect('category/' . $category_slug . '/' . $prod_slug)->with('status', 'Thank you for writing a review ');
            }
        } else {
            // return $request->input('product_id');
            return redirect()->back()->with('status', 'It is not an existing product');
        }
    }
    public function edit($product_slug)
    {
        $product = Product::where('slug', $product_slug)->where('status', '0')->first();
        if ($product) {
            $product_id = $product->id;
            $review = Review::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
            if ($review) {
                return view('frontend.review.edit', compact('review'));
            } else {
                return redirect()->back()->with('status', 'this link is broken');
            }
        } else {
            return redirect()->back()->with('status', 'this link is broken');
        }
    }
    public function update(Request $request)
    {

        $user_review = $request->input('user_review');
        if ($user_review != '') {
            $review_id = $request->input('review_id');
            $review = Review::where('id', $review_id)->where('user_id', Auth::id())->first();
            if ($review) {
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('category/' . $review->product->category->slug . '/' . $review->product->slug)->with('status', 'Product updated successfully');
            } else {
                return redirect()->back()->with('status', 'this link is broken');
            }
        } else {
            return redirect()->back()->with('status', 'You can not Submit empty review ');
        }
    }
}
