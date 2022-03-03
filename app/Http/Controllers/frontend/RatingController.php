<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    //
    public function add(Request $request)
    {
        //product_id=5&product_rating=4
        $stars_rated = $request->input('product_rating');
        $product_id =  $request->input('product_id');
        $product = Product::where('id', $product_id)->where('status', 0)->first();
        //product exist
        if ($product) {
            $verified_purchase = Order::where('orders.user_id', Auth::id())
                ->join('order_items', 'orders.id', 'order_items.order_id')
                ->where('order_items.prod_id', $product_id)->get();

            //if user sell this product
            if ($verified_purchase->count() > 0) {
                $existing_rating = Rating::where('user_id', Auth::id())->where('prod_id', $product_id)->first();
                //if already rated
                if ($existing_rating) {
                    $existing_rating->stars_rated = $stars_rated;
                } else {
                    //create rate
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' => $product_id,
                        'stars_rated' => $stars_rated,
                    ]);
                }

                return redirect('')->back()->with('status', "Thanks for Rating this  product");
            } else {
                return redirect('')->back()->with('status', "the link is brockennn");
            }
        } else {
            return redirect('')->back()->with('status', "no broduct");
        }
    }
}
