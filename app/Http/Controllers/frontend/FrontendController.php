<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Foreach_;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $trending_products = Product::where('trending', '1')->take(15)->get();
        $popular_category = Category::where('popular', '1')->take(15)->get();
        return view('frontend.index', compact('trending_products'), compact('popular_category'));
    }
    public function category()
    {
        $category = Category::where('status', '0')->get();

        return view('frontend.category', compact('category'));
    }
    public function viewcategory($slug)
    {
        if (Category::where('slug', $slug)->exists()) {
            $category = Category::where('slug', $slug)->first();
            $products = Product::where('cate_id', $category->id)->where('status', '0')->get();

            return view('frontend.products.index', compact('category', 'products'));
        } else {
            return redirect('/category')->with('status', 'Category Do not found');
        }
    }
    public function productview($cate_slug, $prod_slug)
    {
        if (Category::where('slug', $cate_slug)->exists()) {
            if (Product::where('slug', $prod_slug)->exists()) {
                $product = Product::where('slug', $prod_slug)->first();
                $ratings = Rating::where('prod_id', $product->id)->get();
                $rating_sum = Rating::where('prod_id', $product->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id', $product->id)->where('user_id', Auth::id())->first();
                $reviews = Review::where('prod_id', $product->id)->get();
                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum / $ratings->count();
                } else {
                    $rating_value = 0;
                }

                return view('frontend.products.view', compact('product', 'ratings', 'rating_value', 'user_rating', 'reviews'));
            } else {
                return redirect('/category')->with('status', 'the link is broken 1');
            }
        } else {
            return redirect('/category')->with('status', 'the link is broken 2');
        }
    }
    public function productListAjax()
    {
        $products = Product::select('name')->where('status', '0')->get();
        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        return $data;
    }
    public function searchProduct(Request $request)
    {
        $product_name = $request->input('product_name');
        if ($product_name != '') {
            $product = Product::where('name', "LIKE", "%$product_name%")->first();
            if ($product) {
                return redirect('category/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with('status', "No Product matched your search");
            }
        } else {
            return redirect()->back();
        }
    }
}
