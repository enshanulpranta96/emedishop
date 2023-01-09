<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $userId = Auth::user()->id;
        $cart_products = json_decode(Cart::where('user_id', $userId)->get());
        $addresses = json_decode(Address::where('user_id', $userId)->get());

        return view('emedishop.checkout', ['cart_products' => $cart_products, 'addresses' => $addresses]);
    }
}


 // 
        // Order::where('user_id', '=', $userId)->delete();
        // $cartData = Cart::where('user_id', '=', $userId)->get()->toArray();

        // //dd($cartData);
        // foreach ($cartData as $item) {
        //     $insert = new Order;
        //     $insert->user_id = $item['user_id'];
        //     $insert->product_id = $item['product_id'];
        //     $insert->product_size = $item['product_size'];
        //     $insert->quantity = $item['quantity'];
        //     $insert->total = $item['total'];
        //     $insert->save();
        // }
