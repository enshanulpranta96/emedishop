<?php

namespace App\Http\Controllers\Emedishop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function cart()
    {
        return view('emedishop.cart');
    }

    public function addToCart($product_id, $price)
    {
        // $product_id = $req->product_id;
        $total = $price;

        $checkExist = Cart::where('product_id', '=', $product_id)->first();

        // var_dump($checkExist);

        if ($checkExist != null) {
            $update = Cart::find($checkExist->id);
            $update->total = $total * $checkExist->quantity;
            $update->quantity = $checkExist->quantity + 1;

            $update->update();
            return redirect()->route('user.cart');
        } else {
            $add = new Cart;
            $add->product_id = $product_id;
            $add->user_id = Auth::user()->id;
            $add->quantity = 1;
            $add->total = $total;
            $add->save();
            return redirect()->route('user.cart');
        }
    }

    public function getCartList()
    {
        // $carts = Cart::where('user_id', '=', Auth::user()->id)->first();

        //joinng cart and product table
        // $allCartsData = Cart::join('products', 'carts.product_id', '=', 'products.id')->where('user_id', '=', Auth::user()->id)->get(['carts.*', 'products.*']);

        $allCartsData = Product::join('carts', 'products.id', '=', 'carts.product_id')->where('user_id', '=', Auth::user()->id)->get();

        // $users = User::join('posts', 'users.id', '=', 'posts.user_id')
        //     ->get(['users.*', 'posts.descrption']);

        // $prodcut_details = json_decode(Product::find($product_id));

        return $allCartsData;
    }

    //add cart quantity
    public function addQuantity(Request $req)
    {
        $id = $req->id;
        $price = $req->price;
        $quantity = $req->quantity + 1;
        $total = $price * $quantity;

        $addQuantity = Cart::where('id', '=', $id)->update(['quantity' => $quantity, 'total' => $total]);

        // $addQuantity = Cart::find($id);
        // $addQuantity->$quantity = $quantity;
        // $addQuantity->$total = $total;
        // $addQuantity->update();

        return $addQuantity;
    }

    //reduce cart quantity
    public function reduceQuantity(Request $req)
    {
        $id = $req->id;
        $price = $req->price;
        $quantity = $req->quantity - 1;
        $total = $price * $quantity;

        $reduceQuantity = Cart::where('id', '=', $id)->update(['quantity' => $quantity, 'total' => $total]);

        return $reduceQuantity;
    }

    //remove from cart
    public function removeFromCart(Request $req)
    {
        $id = $req->id;
        $price = $req->price;
        $quantity = $req->quantity - 1;
        $total = $price * $quantity;

        $removeFromCart = Cart::where('id', '=', $id)->delete();

        return $removeFromCart;
    }




    //without auth
    public function without_auth()
    {
        return redirect()->route('user.login')->with('error', 'Plese login before add to cart or order!');
    }
}
