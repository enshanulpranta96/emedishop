<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ConversationsController extends Controller
{

    public function admin_chat(){
            $id = Auth::guard('admin')->user()->id;
            $tickets = json_decode(Ticket::where('user2_id', '=', $id)->orderBy('id', 'desc')->get());
            // return $tickets;
            return view('dashboard.admin.chat.conversations', ['tickets' => $tickets]);
    }
    public function vendor_Chat(){
            $id = Auth::guard('vendor')->user()->id;
            $tickets = json_decode(Ticket::where('user2_id', '=', $id)->orderBy('id', 'desc')->get());
            // return $tickets;
            return view('dashboard.vendor.chat.conversations', ['tickets' => $tickets]);
    }
    // public function index(){
    //     if(Auth::user()->id){
    //         $id = Auth::user()->id;
    //     } elseif(Auth::guard('vendor')->user()->id){
    //         $id = Auth::guard('vendor')->user()->id;
    //     } elseif(Auth::guard('admin')->user()->id){
    //         $id = Auth::guard('admin')->user()->id;
    //     }
    //     $tickets = json_decode(Ticket::where('user_id', '=', $id)->orderBy('id', 'desc')->get());
    //     return view('', ['data' => $tickets]);
    // }
    public function getChat(Request $req){
        // Auth::user()->id && $id = Auth::user()->id;
        // Auth::guard('vendor')->user()->id && $id =  Auth::guard('vendor')->user()->id;
        // Auth::guard('admin')->user()->id && $id =  Auth::guard('admin')->user()->id;
        // $tickets = json_decode(Ticket::where('user_id', '=', $id)->orderBy('id', 'desc')->get());
        $conv = Ticket::join('messages', 'tickets.id', '=', 'messages.ticket_id')->where('ticket_id', '=', $req->ticket_id)->orderBy('ticket_id', 'asc')->get();
        return $conv;
    }

    public function replayMsg(Request $req){
        // if(Auth::user()->id){
        //     $id = Auth::user()->id;
        //     $name = Auth::user()->name;
        //     $sent_by = 'User';
        // } elseif(Auth::guard('vendor')->user()->id){
        //     $id = Auth::guard('vendor')->user()->id;
        //     $name = Auth::guard('vendor')->user()->name;
        //     $sent_by = 'Vendor';
        // } elseif(Auth::guard('admin')->user()->id){
        //     $id = Auth::guard('admin')->user()->id;
        //     $name = Auth::guard('admin')->user()->name;
        //     $sent_by = 'Admin';
        // }
        // return $req;
        $message = new Message;
        $message->user_id = $req->user_id;
        $message->ticket_id = $req->ticket_id;
        $message->message = $req->message;
        $message->sent_by = $req->sent_by;
        $message->name = $req->name;
        $message->save();

        if($message){
            return $message;
        }
}

    // public function sendMsg(Request $req){
    //     $message = $req->message;
    //     $ticket_id = $req->ticket_id;
    //     $sent_by = $req->sent_by;
    //     $user1_id = $req->user1_id;
    //     $user1_name = $req->user1_name;
    //     $user2_id = $req->user2_id;
    //     if($sent_by == 'Vendor'){
    //         $user2_name = User::where('id', $user2_id)->first('name');
    //     }
        
    //     if($ticket_id != 'none'){
    //         $msg = new Message;
    //         $msg->ticket_id = $ticket_id;
    //         $msg->user_id = $user1_id;
    //         $msg->sent_by = $sent_by;
    //         $msg->name = $user1_name;
    //         $msg->message = $message;
    //         $msg->save();
    //         return $msg;
    //     } else {
    //         $create = new Ticket;
    //         $create->user1_id = $user1_id;
    //         $create->user1_name = $user1_name;
    //         $create->user2_id = $user2_id;
    //         $create->user2_name = $user2_name;
    //         $create->status = 'open';
    //         $create->save();
    //         if($create){
    //             $msg1 = new Message;
    //             $msg1->ticket_id = $create->id;
    //             $msg1->user_id = $user1_id;
    //             $msg1->sent_by = $sent_by;
    //             $msg1->name = $user1_name;
    //             $msg1->message = $message;
    //             $msg1->save();
    //             if($msg1){
    //                 return 200;
    //             }
    //         }
    //     }
    // }

    public function chatWithVendor($ticket_id){
        // $vendor_id = $req->vendor_id;
        return view('chat.chat', compact('ticket_id'));
    }

    public function adminChatPage($ticket_id){
        // $vendor_id = $req->vendor_id;
        return view('dashboard.admin.chat.chat', compact('ticket_id'));
    }

    public function vendorChatPage($ticket_id){
        // $vendor_id = $req->vendor_id;
        return view('dashboard.vendor.chat.chat', compact('ticket_id'));
    }

    


    public function vendorchat($user2, $user2_id){
        if(Auth::user()->id){
            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $sent_by = 'User';
        } elseif(Auth::guard('vendor')->user()->id){
            $id = Auth::guard('vendor')->user()->id;
            $name = Auth::guard('vendor')->user()->name;
            $sent_by = 'Vendor';
        } elseif(Auth::guard('admin')->user()->id){
            $id = Auth::guard('admin')->user()->id;
            $name = Auth::guard('admin')->user()->name;
            $sent_by = 'Admin';
        }

        if($user2 == 'Vendor'){
             $user2_name = Vendor::where('id', $user2_id)->get('shopname')[0]->shopname;
         } elseif ($user2 == 'User'){
            $user2_name = User::where('id', $user2_id)->get('name')[0]->name;
         } elseif ($user2 == 'Admin'){
            $user2_name = Admin::where('id', $user2_id)->get('name')[0]->name;
            // return $user2_name;
         }

        // $ticket_id = 'none';
        $user1_id = $id;
        $user1_name = $name;

        // return $user2_name;

        $findTicketId = Ticket::where('user2_id', $user2_id)->where('user1_id', $user1_id)->get('id');
        if(count($findTicketId)>0){
            $formatedId = $findTicketId[0]->id;
            return view('chat.chat')->with('ticket_id', $formatedId);
        } else {
            $create = new Ticket;
            $create->user1_id = $user1_id;
            $create->user1_name = $user1_name;
            $create->user2_id = $user2_id;
            $create->user2_name = $user2_name;
            $create->status = 'open';
            $create->save();
            // return $create->id;
            return view('chat.chat')->with('ticket_id', $create->id);
                // return view('chat.chat')->with('ticket_id', $formatedId);
             }

        // $filteredId = $findTicketId[0]->id;
        // return $findTicketId;

        // if ($filteredId == null || $filteredId == '') {
        //     $create = new Ticket;
        //     $create->user1_id = $user1_id;
        //     $create->user1_name = $user1_name;
        //     $create->user2_id = $user2_id;
        //     $create->user2_name = $user2_name;
        //     $create->status = 'open';
        //     $create->save();
        //     // return $create->id;
        //     return view('chat.chat')->with('ticket_id', $create->id);
        // } else {
        //     $formatedId = $findTicketId[0]->id;
        //     return $formatedId;
        //     // return view('chat.chat')->with('ticket_id', $formatedId);
        //  }
        


        // if($ticket_id != 'none'){
        //     $create = new Ticket;
        //     $create->user1_id = $user1_id;
        //     $create->user1_name = $user1_name;
        //     $create->user2_id = $user2_id;
        //     $create->user2_name = $user2_name;
        //     $create->status = 'open';
        //     $create->save();
        // } else {
        //     return 
        // }
         
        // $user2_name = 



        // $vendor_id = $req->vendor_id;
        // return view('chat.chat', compact('ticket_id'));
    }

    

    // public function getChat(Request $req){
    //     $user_id = $req->user_id;
    //     // $chats = Message::where('user_id', '=', $user_id)->orderBy('id', 'desc')->get();

    //     // $chats = Message::where('ticket_id', $req->ticket_id)->get();
    //     $conv = Ticket::join('messages', 'tickets.id', '=', 'messages.ticket_id')->where('ticket_id', '=', $req->ticket_id)->orderBy('ticket_id', 'desc')->get();
    //     return  $conv;
    //     // return $chats;
    // }

    public function getMembers(){
        $tickets = json_decode(Ticket::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get());
        return $tickets;
    }

    public function create(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'department' => 'required',
            'related_service' => 'required',
            'priority' => 'required',
            'message' => 'required',
        ]);

        $create = new Ticket;
        $create->user_id = Auth::user()->id;
        $create->name = $req->name;
        $create->email = $req->email;
        $create->subject = $req->subject;
        $create->department = $req->department;
        $create->related_service = $req->related_service;
        $create->priority = $req->priority;
        $create->message = $req->message;
        $create->status = "open";
        $req->login_details && $create->message = $req->login_details;
        $req->mysql_details && $create->message = $req->mysql_details;
        $req->coltrol_panel_details && $create->message = $req->coltrol_panel_details;
        $create->save();
        if($create){
            //sending email notification
            $data=[
                'subject' => 'NEW TICKET REQUEST',
                'email' => $req->email,
                'name' => $req->name,
                'title' => $req->subject,
                'department' => $req->department,
                'priority' => $req->priority,
                'message' => $req->message,
            ];

            // Mail::send('backend.supports.ticketResponse', $data, function($message)use($data) {
            //     $message->from('support_office@bobosohomail.com', 'office')
            //             ->to('quaziakash@gmail.com', 'user')
            //             ->cc('sajedul0101@gmail.com', 'user')
            //             ->subject($data["subject"], 'pdf file');
            // });
            
            // Mail::send('backend.writes.mail', $data, function($message)use($data) {
            //     $message->
            //     from('support_office@bobosohomail.com', 'office')
            //         ->to($data["email"], 'user')
            //         ->subject($data["subject"], 'pdf file');
            // });

            return redirect()->route('user.supports')->with('success', 'Tocken Submited');
        }
    }

    public function conversation($ticket_id){
        $ticketDetails = json_decode(Ticket::where('id', $ticket_id)->get());
        return view('backend.supports.conversations', ['ticketDetails' => $ticketDetails]);
    }

    

    

    public function getConversation(Request $req){
        $conversation = Message::where('ticket_id', $req->ticket_id)->get();
        $conv = Ticket::join('messages', 'tickets.id', '=', 'messages.ticket_id')->where('ticket_id', '=', $req->ticket_id)->orderBy('ticket_id', 'desc')->get();
        return  $conv;
    }

    public function adminProfile(){
        $id = Auth::guard('admin')->user()->id;
        $tickets = json_decode(Ticket::where('user1_id', '=', $id)->orderBy('id', 'desc')->get());
        return view('chat.chat')->with('tickets', $tickets);
    }
}
