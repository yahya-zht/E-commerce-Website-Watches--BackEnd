<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $Products=Product::all();
        $Products = Product::with('provider')->get();
        // Product::with('provider')->get();
        // $Providers=Provider::all();
        // print_r($Products->provider->Name);
        // return response()->json(['Products'=>$Products,'Providers'=>$Providers,'status'=>'imported products successfully ']);
        return response()->json(['Products'=>$Products,'status'=>'imported products successfully ']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Ref' =>'required',
            'Name' =>'required',
            'Description' =>'required',
            'Image_Product' =>'required|image',
            'Price_Purchase' =>'required',
            'Price_First' =>'required',
            'Price_Sale' =>'required',
            'Quantity' =>'required',
            'Sales' =>'required',
            'provider_id' =>'required',
        ]);
         if ($request->hasFile('Image_Product')) {
            $file=$request->file('Image_Product');
            $filename=$file->getClientOriginalExtension();
            $imageName=Str::random().'.'.$filename;
            Storage::disk('public')->makeDirectory('Images/product');
            // Storage::disk('public')->putFileAs('Product/images/',$filename,$imageName);
             Storage::disk('public')->put('Images/product/'. $imageName, file_get_contents($file));
        }
        // Product::create($request->post());
        Product::create($request->post()+['Image_Product'=>$imageName]);
        return response()->json(["status"=>"Success Added Product "]);
    }

    public function show(Product $Product)
    {
        // $Product=Product::with('provider')->find($Product->id);
        $Product->load('provider');
        return response()->json(["product"=>$Product]);
    }

    public function update(Request $request, Product $Product){
        $request->validate([
            'Ref' =>'required',
            'Name' =>'required',
            'Description' =>'required',
            'Image_Product' =>'nullable',
            'Price_Purchase' =>'required',
            'Price_First' =>'required',
            'Price_Sale' =>'required',
            'Quantity' =>'required',
            'Sales' =>'required',
            'provider_id' =>'required',
        ]);
        $Product->fill($request->post())->update();
        if ($request->hasFile('Image_Product')) {
            if($Product->Image_Product){
                $exist=Storage::disk('public')->exists("Images/product/{$Product->Image_Product}");
                if($exist){
                    Storage::disk('public')->delete("Images/product/{$Product->Image_Product}");
                }
            }
            $file=$request->file('Image_Product');
            $filename=$file->getClientOriginalExtension();
            $imageName=Str::random().'.'.$filename;
            Storage::disk('public')->makeDirectory('Images/product');
            // Storage::disk('public')->putFileAs('Product/images/',$filename,$imageName);
            Storage::disk('public')->put('Images/product/'. $imageName, file_get_contents($file));
            $Product->Image_Product=$imageName;
        }
        // if($request->hasFile('image')){
        //     if($Product->image){
        //         $exist=Storage::disk('public')->exists("Product/images/{$Product->image}");
        //         if($exist){
        //             Storage::disk('public')->delete("Product/images/{$Product->image}");
        //         }
        //     }
        //     $imageName=Str::random().'.'.$request->image->extension();
        //     // Storage::disk('public')->putFileAs('Product/images',$request->image,$imageName);
        //     $Product->image=$imageName;
        // }
        $Product->save();
        return response()->json(["status"=>"Success Updated Product "]);
    }


    public function destroy(Product $Product)
    {
        if($Product->Image_Product){
            $exist=Storage::disk('public')->exists("Images/product/{$Product->Image_Product}");
            if($exist){
                Storage::disk('public')->delete("Images/product/{$Product->Image_Product}");          
            }
        }
        $Product->delete();
        return response()->json(["status"=>"Success Deleted Product "]);
    }
}
