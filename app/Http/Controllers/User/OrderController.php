<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class OrderController extends Controller
{
    public function createAddress(Request $req)
    {
        // $req->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'whatsapp' => 'required',
        //     'mobile' => 'required',
        //     'zip_code' => 'required',
        //     'address' => 'required',
        // ]);

        $user_id = Auth::user()->id;

        // return $req;

        $address = new Address;
        $address->user_id = $user_id;
        $address->name = $req->name;
        $address->email = $req->email;
        $address->whatsapp = $req->whatsapp;
        $address->mobile = $req->mobile;
        $address->state = $req->state;
        $address->city = $req->city;
        $address->zip_code = $req->zip_code;
        $address->address = $req->address;
        $address->save();
        return  $address->id;

        // $order = new Order;
        // $order->user_id = $user_id;  
        // $create->name = $req->name;
        // $create->name = $req->name;
        // $create->name = $req->name;
    }

    public function createOrder(Request $req)
    {
        $invocie = $req->invoice;

        function generateInvoice()
        {
            $invocie = (rand(1000, 100000000));
            return $invocie;
        };

        $invoiceExists = Order::where('invoice', $invocie)->exists();

        if ($invoiceExists !== '' || $invoiceExists !== null || $invoiceExists !== false) {
            generateInvoice();
        }

        $product_details = json_encode($req->product_details);

        $user_id = Auth::user()->id;
        $create = new Order;
        $create->user_id = $user_id;
        $create->product_details = $product_details;
        $create->payment_method = $req->payment_method;
        $create->payment_status = $req->payment_status;
        $create->vendor_id = $req->product_details[0]['vendor_id'];
        $create->subtotal = $req->subtotal;
        $create->shipping = $req->shipping;
        $create->total = $req->total;
        $create->address_id = $req->address_id;
        $create->trans_id = $req->trans_id;
        $create->status = 'PENDING';
        $create->invoice = $invocie;
        $create->save();
        if ($create) {
            Cart::where('user_id', $user_id)->delete();
        }
        return $create->id;
        // return $req;
    }

    public function uploadPrescription(Request $req){

        if ($req->file('image')) {
            $file = $req->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/prescription'), $filename);

            $add = Order::find($req->order_id);
            $add->prescription = $filename;
            $add->save();
            return $add;
        }
        
    }
}
