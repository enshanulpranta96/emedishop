<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('dashboard.admin.users.users')->with('users', $users);
    }

    public function request()
    {
        $req = User::where('acc_status', '=', 'new')->get();
        return view('dashboard.admin.users.new_user_request')->with('data', $req);
    }

    public function active_user($id)
    {
        $active = User::find($id);
        $active->acc_status = 'active';
        $active->save();
        $notificaton = [
            'message' => 'Account Activated',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notificaton);
    }

    public function action($id, $acc_status)
    {
        // $status = '';
        // if ($acc_status == 'deactivated') {
        //     $status == 'active';
        // } else {
        //     $status == 'deactivated';
        // }
        $active = User::find($id);
        $active->acc_status = $acc_status;
        $active->save();
        $notificaton = [
            'message' => 'Account ' . $acc_status,
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notificaton);
    }

    public function create(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password'
        ], [
            'cpassword.same' => 'Password must match!!! Try again...'
        ]);

        $user = new User;
        $user->name = $req->name;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->email = $req->email;
        $user->acc_status = "active";
        $user->password = Hash::make($req->password);
        $user->save();

        if ($user) {
            return redirect()->route('user.login')->with('success', 'Your have registered successfully...');
        } else {
            return redirect()->back()->with('error', 'Somthing went wrong! Please try agian later...');
        }
    }

    public function check(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'No user found with this email!'
        ]);

        $creds = $req->only('email', 'password');

        if (Auth::attempt($creds)) {
            if (Auth::user()->acc_status == 'new') {
                // Auth::logout();
                // return redirect()->route('user.login')->with('error', 'We are reviewing your request, Please wait for admin approval!!!');
                $notificaton = [
                    'message' => 'Welcome ' . Auth::user()->name,
                    'alert-type' => 'success'
                ];
                return redirect()->route('user.index')->with($notificaton);
            } elseif (Auth::user()->acc_status == 'deactivated') {
                Auth::logout();
                return redirect()->route('user.login')->with('error', 'Sorry your account deactivated!!! Contact with admin...');
            } else {
                $notificaton = [
                    'message' => 'Welcome ' . Auth::user()->name,
                    'alert-type' => 'success'
                ];
                return redirect()->route('user.index')->with($notificaton);
            }
        } else {
            return redirect()->route('user.login')->with('error', 'Wrong Credientials!!!');
        }

        // if (Auth::attempt($creds)) {
        //     return redirect()->route('user.index');
        // } else {
        //     return redirect()->route('user.login')->with('error', 'Wrong Credientials!!!');
        // }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
