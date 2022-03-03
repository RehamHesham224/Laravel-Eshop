<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }
    public function add(Request $request)
    {
        if (Auth::check()) {
            $prod_id = $request->input('product_id');
            if (Product::find($prod_id)) {

                $wishlistItem = new Wishlist();
                $wishlistItem->prod_id = $prod_id;
                $wishlistItem->user_id = Auth::id();
                $wishlistItem->save();
                return response()->json(['status' => ' Added to wishlist']);
            } else {
                return response()->json(['status' =>  "Doesn't exist in wishlist"]);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Wishlist::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $wishlistItem = Wishlist::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                $wishlistItem->delete();
                return response()->json(['status' => 'Item removed from wishlist']);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }
    public function wishlistCount()
    {
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishlistCount]);
    }
}
