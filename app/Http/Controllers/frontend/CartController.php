<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function addProduct(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');
        if (Auth::check()) {
            $prod_check = Product::where('id', $product_id)->first();
            if ($prod_check) {
                if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $prod_check->name . ' Already Added to cart']);
                } else {
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->user_id = Auth::id();
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name . ' Added to Cart']);
                }
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }
    public function viewCart()
    {
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.cart', compact('cartitems'));
    }
    public function deleteProduct(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cartitem = Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                $cartitem->delete();
                return response()->json(['status' => 'Product Delted successfully']);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }
    public  function updateCart(Request $request)
    {
        if (Auth::check()) {
            $product_id = $request->input('product_id');
            $product_qty = $request->input('product_qty');
            if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->prod_id = $product_id;
                $cart->prod_qty = $product_qty;
                $cart->user_id = Auth::id();
                $cart->update();
                return response()->json(['status' => 'Quantity Updated successfully']);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }
    public function cartCount()
    {
        $cartCount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartCount]);
    }
}
