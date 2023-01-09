<?php

namespace App\Http\Controllers\Emedishop;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmedishopController extends Controller
{
    //showing all products to store
    public function mediStore()
    {
        $allproducts = Product::paginate(12);
        return view('emedishop.pages.store')->with('allproducts', $allproducts);
    }

    // details page
    public function productDetails(Request $req)
    {
        $getProdcut = Product::where('id', '=', $req->id)->first();
        $similarProduct = Product::latest()->take(5)->get();
        return view('emedishop.prodcut_details')->with(['product' => $getProdcut, 'mayalsolike' => $similarProduct]);
    }

    //add to cart from details page
    public function addToCart(Request $req)
    {
        $product_id = $req->product_id;
        $total = $req->price;
        $quantity = $req->quantity;

        $checkExist = Cart::where('product_id', '=', $product_id)->first();

        // var_dump($checkExist);

        if ($checkExist != null) {
            $update = Cart::find($checkExist->id);
            $update->total = $total * ($checkExist->quantity + $quantity);
            $update->quantity = $checkExist->quantity + $quantity;

            $update->update();
            return redirect()->route('user.cart');
        } else {
            $add = new Cart;
            $add->product_id = $product_id;
            $add->user_id = Auth::user()->id;
            $add->quantity = $quantity;
            $add->total = $total;
            $add->save();
            return redirect()->route('user.cart');
        }
    }

    //showing all covid products
    // public function covid()
    // {
    //     $products = Product::where('category', '=', 'COVID 19')->paginate(12);
    //     return view('emedishop.pages.covid')->with('products', $products);
    // }

    // //showing all babyAndMom products
    // public function babyAndMom()
    // {
    //     $products = Product::where('category', '=', 'BABY & MOM')->paginate(12);
    //     return view('emedishop.pages.babyandmom')->with('products', $products);
    // }

    // //showing all femaleHygiene products
    // public function femaleHygiene()
    // {
    //     $products = Product::where('category', '=', 'FEMALE HYGIENE')->paginate(12);
    //     return view('emedishop.pages.female_hygine')->with('products', $products);
    // }

    // //showing all beautyCare products
    // public function beautyCare()
    // {
    //     $products = Product::where('category', '=', 'BEAUTY CARE')->paginate(12);
    //     return view('emedishop.pages.beautycare')->with('products', $products);
    // }

    // //showing all diabetic products
    // public function diabetic()
    // {
    //     $products = Product::where('category', '=', 'DIABETIC')->paginate(12);
    //     return view('emedishop.pages.diabetic')->with('products', $products);
    // }

    // //showing all personalCare products
    // public function personalCare()
    // {
    //     $products = Product::where('category', '=', 'PERSONAL CARE')->paginate(12);
    //     return view('emedishop.pages.personal_care')->with('products', $products);
    // }

    // //showing all sexualWellbeing products
    // public function sexualWellbeing()
    // {
    //     $products = Product::where('category', '=', 'SEXUAL WELLBEING')->paginate(12);
    //     return view('emedishop.pages.sexual_wellbeing')->with('products', $products);
    // }

    //contact page
    public function contact()
    {
        return view('emedishop.pages.contact');
    }

    //search page
    public function search(Request $req)
    {
        $search = $req->search;
        $result = Product::query()
            ->where('product_name', 'LIKE', "%{$search}%")
            ->orWhere('brand_name', 'LIKE', "%{$search}%")
            ->paginate(12);
        return view('emedishop.pages.search')->with('result', $result);
    }
}
