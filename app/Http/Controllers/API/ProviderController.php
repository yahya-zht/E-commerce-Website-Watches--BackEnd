<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $Providers=Provider::all();
        return response()->json(["Providers"=>$Providers,"Status"=>"Imported providers successfully"]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Ref' =>'required',
            'Name' =>'required',
            'Email' =>'required|email',
            'Telephone' =>'required|numeric',
            'Address' =>'required',
            'City' =>'required',
            'Country' =>'required',
        ]);
        Provider::create($request->post());
        return response()->json(["status"=>"Success Added Provider "]);
    }


    public function show(Provider $Provider)
    {
        return response()->json(["Provider"=>$Provider]);
    }

    public function update(Request $request, Provider $Provider)
    {
        $request->validate(
            [
                'Ref' =>'required',
                'Name' =>'required',
                'Email' =>'required|email',
                'Telephone' =>'required|numeric',
                'Address' =>'required',
                'City' =>'required',
                'Country' =>'required',
            ]
            );
            // $Provider->fill($request->post())->update();
            // $Provider->save();
            $Provider->update($request->post());
            return response()->json(["status"=>"Success Updated Provider "]);
    }


    public function destroy(Provider $Provider)
    {
        $Provider->delete();
        return response()->json(["status"=>"Success Deleted Provider "]);
    }
    public function search($query)
    {
        if (!empty($query)) {
            $products = Provider::where('Ref', 'like', "%$query%")->get();
            return response()->json($products);
        } else {
            return response()->json([], 400);
        }
    }
}
