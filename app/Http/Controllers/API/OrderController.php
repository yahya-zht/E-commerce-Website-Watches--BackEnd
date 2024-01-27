<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Orders=Order::all();
        return response()->json(["Orders"=>$Orders,"Status"=>"All Orders"]);
    }
    function generateRandomOrderRef() {
        // Generate a random uppercase letter
        $randomLetter = chr(rand(65, 90)); // ASCII values for A-Z

        // Generate a random 4-digit number
        $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Combine the letter and number to create the reference code
        $orderRef = $randomLetter . $randomNumber;

        return $orderRef;
    }

    public function store(Request $request){
    // dd($request);
    $request->validate([
        "Name"=>"required",
        "Telephone"=>"required",
        // "Email"=>"required",
        // "Address"=>"required",
        "City"=>"required",
        "Country"=>"required"
    ]);
    // $orderRef = generateRandomOrderRef();
        function generateRandomOrderRef() {
            // Generate a random uppercase letter
            $randomLetter = chr(rand(65, 90)); // ASCII values for A-Z

            // Generate a random 4-digit number
            $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

            // Combine the letter and number to create the reference code
            $orderRef = $randomLetter . $randomNumber;

            return $orderRef;
        }
        // productIds->
                // $ArtNew->categories()->sync($request->input('category', []));
        $Ref=generateRandomOrderRef();
        $Order=Order::create($request->all()+['Ref'=>$Ref]);
        $productListArray = is_array($request->ListProduct) ? $request->ListProduct : json_decode($request->ListProduct, true);
        foreach ($productListArray as $productId) {
        $Quantity = $productId['Quantity']; 
        $Total_Price = $productId['Total_Price'];
        $Date = date("Y-m-d H:i:s");
        $Order->products()->attach($productId['product_id'], [
            'Quantity' => $Quantity,
            'Total_Price' => $Total_Price,
            'created_at' => $Date,
            'updated_at' => $Date,
        ]);
     
    }
        return response()->json(["Order"=>$Order,"Status"=>"Order Created"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $Order){
        
        // $products = $Order->products->with('Quantity', 'Total_Price')->get();
        $Order->products;
        return response()->json(["Order"=>$Order,"Status"=>"Order Details"]);
        // $Order = Order::with('products')->find($id);
        // $Order->load('products');
        // return response()->json(["Order"=>$Order,"Status"=>"Order Details"]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $Order)
    {
        $Order->delete();
        return response()->json(["Order"=>$Order,"Status"=>"Order Deleted"]);
        
    }
}
