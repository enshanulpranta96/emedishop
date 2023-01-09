<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductsController extends Controller
{
    public function getProducts()
    {
        $products = Product::where('vendor_id', '=', Auth::guard('vendor')->user()->id)->get();
        return view('dashboard.vendor.products.products')->with('data', $products);
    }

    public function createProductPage()
    {
        $getCategories = Categorie::get();
        return view('dashboard.vendor.products.create')->with('data', $getCategories);
    }

    public function createProduct(Request $req)
    {
        $req->validate([
            'product_name' => 'required',
            'brand_name' => 'required',
            'pieces' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'image' => 'required',
            'product_des' => 'required',
        ]);

        // if ($req->file('image')) {
        //     $file = $req->file('image');
        //     $filename = date('YmdHi') . $file->getClientOriginalName();
        //     $file->move(public_path('public/image'), $filename);
        // }

        $create = new Product;
        $create->product_name = $req->product_name;
        $create->brand_name = $req->brand_name;
        $create->pieces = $req->pieces;
        $create->category = $req->category;
        $create->vendor_id = $req->vendor_id;
        $create->price = $req->price;
        $create->stock = $req->stock;
        if ($req->file('image')) {
            $file = $req->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $create->image = $filename;
        }

        $create->product_des = $req->product_des;
        $create->save();

        if ($create) {
            $notificaton = [
                'message' => 'New Product Created',
                'alert-type' => 'success'
            ];
            return redirect()->route('vendor.products')->with($notificaton);
        } else {
            $notificaton = [
                'message' => 'Somthing went wrong! Please try agian later...',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notificaton);
        }
    }

    public function editProduct(Request $req)
    {
        $getData = json_decode(Product::find($req->id));
        $getCategories = json_decode(Categorie::get());
        return view('dashboard.vendor.products.edit')->with(['data' => $getData, 'categories' => $getCategories]);
    }


    public function update(Request $req)
    {
        $update = Product::find($req->product_id);
        $update->product_name = $req->product_name;
        $update->brand_name = $req->brand_name;
        $update->pieces = $req->pieces;
        $update->category = $req->category;
        $update->price = $req->price;
        $update->stock = $req->stock;
        if ($req->file('image')) {
            $file = $req->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $update->image = $filename;
        }

        $update->product_des = $req->product_des;
        $update->update();

        if ($update) {
            $notificaton = [
                'message' => 'Prodcut Updated',
                'alert-type' => 'success'
            ];
            return redirect()->route('vendor.products')->with($notificaton);
        } else {
            $notificaton = [
                'message' => 'Somthing went wrong! Please try agian later...',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notificaton);
        }
    }

    public function deleteProduct($id)
    {
        $delete = Product::find($id)->delete();
        if ($delete) {
            $notificaton = [
                'message' => 'Prodcut Deleted',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notificaton);
        }
    }
}
