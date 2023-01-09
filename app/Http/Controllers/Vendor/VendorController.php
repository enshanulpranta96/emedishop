<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    public function home()
    {
        $productCount = Product::where('vendor_id', '=', Auth::guard('vendor')->user()->id)->count();
        return view('dashboard.vendor.home')->with('productCount', $productCount);
    }
    public function create(Request $req)
    {
        $req->validate([
            'shopname' => 'required',
            'phone' => 'required|min:11',
            'address' => 'required',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ], [
            'cpassword.same' => 'Password must match!!! Try again...'
        ]);

        $vendor = new Vendor;
        $vendor->shopname = $req->shopname;
        $vendor->acc_status = 'new';
        $vendor->phone = $req->phone;
        $vendor->address = $req->address;
        $vendor->email = $req->email;
        $vendor->password = Hash::make($req->password);
        $vendor->save();

        if ($vendor) {
            return redirect()->back()->with('success', 'Vendor registered successfully... Wait for admin approval!!!');
        } else {
            return redirect()->back()->with('error', 'Somthing went wrong! Please try agian later...');
        }
    }

    public function check(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:vendors,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'No user found with this email!'
        ]);

        $creds = $req->only('email', 'password');

        if (Auth::guard('vendor')->attempt($creds)) {
            if (Auth::guard('vendor')->user()->acc_status == 'new') {
                Auth::guard('vendor')->logout();
                return redirect()->route('vendor.login')->with('fail', 'We are reviewing your request, Please wait for admin approval!!!');
            } elseif (Auth::guard('vendor')->user()->acc_status == 'deactivated') {
                Auth::guard('vendor')->logout();
                return redirect()->route('vendor.login')->with('fail', 'Sorry your account deactivated!!! Contact with admin...');
            } else {
                $notificaton = [
                    'message' => 'Welcome ' . Auth::guard('vendor')->user()->shopname,
                    'alert-type' => 'success'
                ];
                return redirect()->route('vendor.home')->with($notificaton);
            }
        } else {
            return redirect()->route('vendor.login')->with('fail', 'Wrong Credientials!!!');
        }
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
}
