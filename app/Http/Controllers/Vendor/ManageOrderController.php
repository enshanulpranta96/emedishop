<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class ManageOrderController extends Controller
{
    public function ManageOrders()
    {
        $vendor_id = Auth::guard('vendor')->user()->id;
        // $orders = Product::join('orders', 'orders.product_id', '=', 'products.id')->where('vendor_id', $vendor_id)->orderBy('orders.id', 'desc')->get();
        //$orders = Order::where('vendor_id', $vendor_id)->orderBy('id', 'desc')->get();

        $newOrders = json_decode(Order::where('status', '=', 'PENDING')->orderBy('id', 'desc')->count());

        // $filteredOrder = [];

        $filteredOrder = Order::all();
        // foreach($allorders as $key => $orders) {
        //     // foreach($key['vendor_id'] as $testorder) {
        //     //     //$order_vendor_id = $testorder->vendor_id;
                
        //         dd($key[]);
        //     // }
            
        //     // if($vendor_id == $order_vendor_id){
        //     //     array_push($filteredOrder, $vendor_id);
        //     // }
            
        // }

        // // dd($filteredOrder);
        return view('dashboard.vendor.orders.orders', compact('filteredOrder', 'newOrders'));
        
    }

    public function orderStatus(Request $req)
    {
        $id = $req->id;
        $status = $req->status;

        $updateStatus = Order::find($id);
        $updateStatus->status = $status;
        $updateStatus->save();

        return redirect()->back();
    }

    public function getOrderDetails(Request $req){
        $product_id = $req->product_id;
        // $vendor_id = $req->vendor_id;
        // $user_id = $req->user_id;
        $address_id = $req->address_id;

        $product = Product::find($product_id);
        $address = Address::find($address_id);

        return ["product" => $product, "address" => $address];
    }

    public function newOrders(){
        $vendor_id = Auth::guard('vendor')->user()->id;
        $newOrders = json_decode(Order::where('status', '=', 'PENDING')->orderBy('id', 'desc')->count());
        $filteredOrder = Order::where('status', '=', 'PENDING')->get();
        return view('dashboard.vendor.orders.orderRequests', compact('filteredOrder', 'newOrders'));
    }

    // public function newOrders()
    // {
    //     $newOrders = Product::join('orders', 'orders.product_id', '=', 'products.id')->where('status', '=', 'PENDING')->orderBy('orders.id', 'desc')->get();;
    //     return view('dashboard.vendor.orders.orderRequests', compact('newOrders'));
    // }
}
