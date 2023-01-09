<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        $activeVendor = Vendor::where('acc_status', '=', 'active')->count();
        $newvendorRequest = Vendor::where('acc_status', '=', 'new')->count();
        $activeUser = User::where('acc_status', '=', 'active')->count();
        $productCount = Product::count();
        $categories = Categorie::count();
        $data = [
            'activeVendor' => $activeVendor,
            'newvendorRequest' => $newvendorRequest,
            'activeUser' => $activeUser,
            'productCount' => $productCount,
            'categories' => $categories,
        ];
        return view('dashboard.admin.home')->with($data);
    }
    public function check(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'No user found with this email!'
        ]);

        $creds = $req->only('email', 'password');

        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Wrong Credientials!!!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
