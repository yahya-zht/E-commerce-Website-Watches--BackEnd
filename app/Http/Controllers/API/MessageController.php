<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Messages=Message::all();
        return response()->json(["Messages"=>$Messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "First_name"=>"required",
            "Last_name"=>"required",
            "Email"=>"required",
            "Message"=>"required",
        ]);
        $Message=new Message();
        $Message->First_name=$request->First_name;
        $Message->Last_name=$request->Last_name;
        $Message->Email=$request->Email;
        $Message->Message=$request->Message;
        $Message->save();
        return response()->json(["Message"=>$Message,"Status"=>"Message Sent"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(["Message"=>$message,"Status"=>"Message Deleted"]);
    }
}
