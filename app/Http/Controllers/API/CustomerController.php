<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Customers=Customer::all();
        return response()->json(["Customers"=>$Customers]);
    }
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            // "email"=>"required",
            "telephone"=>"required",
            "City"=>"required",
            // "Country"=>"required",
        ]);
        $Customer=new Customer();
        $Customer->name=$request->name;
        $Customer->email=$request->email;
        $Customer->telephone=$request->telephone;
        $Customer->City=$request->City;
        $Customer->Country=$request->Country;
        $Customer->save();
        return response()->json(["message"=>"Success Added Provider"]);
    }
    public function show(Customer $Customer)
    {
        return response()->json(["Customer"=>$Customer]);
    }

    public function update(Request $request, Customer $Customer)
    {
        $request->validate([
            "name"=>"required",
            // "email"=>"required",
            "telephone"=>"required",
            "City"=>"required",
            // "Country"=>"required",
        ]);
        $Customer->update($request->post());
        return response()->json(["message"=>"Success Updated Provider"]);
    }

    public function destroy(Customer $Customer)
    {
        $Customer->delete();
        return response()->json(["message"=>"Success Deleted Provider"]);
    }
    public function search($query)
    {
        if (!empty($query)) {
            $products = Customer::where('telephone', 'like', "%$query%")->get();
            return response()->json($products);
        } else {
            return response()->json([], 400);
        }
    }
}
