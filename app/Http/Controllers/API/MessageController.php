<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    /**
     * Store a newly created resource in storage.
     */
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
    public function show(Message $Message)
    {
        return response()->json(["Message"=>$Message]);
    }
    // public function downloadPDF(string $id){
    //     $Message=Message::find($id);
    //     // $invoice=$request->input();
    //     $html = view('Message_pdf', compact('Message'))->render();
    //     $dompdf = new Dompdf();
    //     $options = new Options();
    //     $dompdf->setOptions($options);
    //     $dompdf->loadHtml($html);
    //     $dompdf->setPaper('A4', 'portrait');
    //     $dompdf->render();
    //     return $dompdf->stream('invoice.pdf');
    // }
public function downloadPDF($id) {
    $Message = Message::findOrFail($id);
    // Logic to generate the PDF or fetch it from storage

    // Example: Generate PDF using Dompdf
    $pdf = FacadePdf::loadView('Message_pdf', compact('Message'));

    // You can customize the file name here
    return $pdf->download('invoice.pdf');
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $Message)
    {
        $Message->delete();
        return response()->json(["Message"=>$Message,"Status"=>"Message Deleted"]);
    }
}
