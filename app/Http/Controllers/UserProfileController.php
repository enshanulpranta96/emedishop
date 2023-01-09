<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function userProfile()
    {
        if(Auth::user()->id){
            $id = Auth::user()->id;
            $user_id = 'user2_id';
            $ticket_user_id = Auth::user()->user_id;
        } elseif(Auth::guard('vendor')->user()->id){
            $id = Auth::guard('vendor')->user()->id;
            $user_id = 'user2_id';
        } elseif(Auth::guard('admin')->user()->id){
            $id = Auth::guard('admin')->user()->id;
        }
        $tickets = json_decode(Ticket::where('user1_id', '=', $id)->orderBy('id', 'desc')->get());
        $userData = json_decode(User::where('id', Auth::user()->id)->get());
 
        return view('emedishop.profile.user_profile', ['data' => $userData, 'tickets' => $tickets]);
    }

    public function getOrders()
    {
        $user_id = Auth::user()->id;
        // $order = Order::join('products', 'orders.product_id', '=', 'products.id')->where('user_id', '=', $user_id)->get(['orders.*', 'products.product_name']);

        $customOrder = Order::where('user_id', '=', $user_id)->get();

        // Ticket::join('messages', 'tickets.id', '=', 'messages.ticket_id')->where('ticket_id', '=', $req->ticket_id)->orderBy('ticket_id', 'desc')->get();
        return $customOrder;
    }

    public function updateProfile(Request $req)
    {
        $name = $req->name;
        $email = $req->email;
        $phone = $req->phone;
        $password = Hash::make($req->password);

        $update = User::find(Auth::user()->id);
        $name && $update->name = $name;
        $email && $update->email = $email;
        $phone && $update->phone = $phone;
        $password && $update->password = $password;
        $update->update();
        if ($update) {
            return $update;
        }
    }

}
