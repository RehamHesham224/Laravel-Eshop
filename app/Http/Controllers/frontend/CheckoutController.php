<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class CheckoutController extends Controller
{
    //
    public function index(Request $request)
    {
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($old_cartitems as $item) {
            if (!Product::where("id", $item->prod_id)->where("qty", ">=", $item->prod_qty)->exists()) {
                if (Cart::where('user_id', Auth::id())->where("id", $item->prod_id)->exists()) {
                    $removeItem = Cart::where('user_id', Auth::id())->where("id", $item->prod_id)->first();
                    $removeItem->delete();
                }
            }
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartitems'));
    }

    public function placeOrder(Request $request)
    {
        //orders table
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');

        $total = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            $total += $prod->products->selling_price;
        }
        $order->total_price = $total;

        $order->tracking_no = "reham" . rand(1111, 9999);
        $order->save();



        $cartitems = Cart::where('user_id', Auth::id())->get();
        foreach ($cartitems as $item) {
            //order_items table
            OrderItem::create([
                'order_id' => $order->id, //order
                'prod_id' => $item->prod_id, //cart
                'qty' => $item->prod_qty, //cart
                'price' => $item->products->selling_price, //product with relation of cart
            ]);
            //products table
            $prod = Product::where('id', $item->prod_id)->first();
            $prod->qty = $prod->qty - $item->prod_qty;
            $prod->update();
        }
        //users Table
        if (Auth::user()->address1 == NULL) {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->input('fname');
            $user->lname = $request->input('lname');
            $user->phone = $request->input('phone');
            $user->address1 = $request->input('address1');
            $user->address2 = $request->input('address2');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        //cart table
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);

        if ($request->input('payment_mode') == "Paid by Razorpay" || $request->input('payment_mode')  == "Paid by Paypal") {
            return response()->json(['status' => 'Order placed Successfully']);
        }

        return redirect('/')->with('status', 'Order placed Successfully');
    }
    public function razorpayCheck(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartItems as $item) {
            $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address1 = $request->input('address1');
        $address2 = $request->input('address2');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pincode = $request->input('pincode');

        return response()->json([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'email' => $email,
            'address1' => $address1,
            'address2' => $address2,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'pincode' => $pincode,
            'total_price' => $total_price

        ]);
    }
}
