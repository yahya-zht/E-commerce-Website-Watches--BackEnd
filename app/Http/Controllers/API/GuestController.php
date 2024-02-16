<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function Products(){
        $Products=Product::select('Name', 'Description','Image_Product','Price_First','Price_Sale','id')->get();
                            // ->where('category', 'Electronics')
                            // ->orderBy('price', 'desc')
                            // ->get();
        return response()->json(['Products'=>$Products,'message'=>'Imported products successfully '],200);
    }
    // public function ShowProduct(Product $Product){
    //     $selectedProduct = $Product->select('Name', 'Description','Image_Product','Price_First','Price_Sale','id')->first();
    //     return response()->json(["product"=>$Product,"message"=>"Product is seccessfully",$Product=>"Product"]);
    // }

    public function ShowProduct(string $id){
        $Product=Product::find($id);
        $selectedProduct = $Product->select('Name', 'Description','Image_Product','Price_First','Price_Sale','id')
                             ->where('id',$id )->first();
        return response()->json(["product"=>$selectedProduct,"message"=>"Product is seccessfully","id"=>$id]);
    }
    public function Categories(){
        $Categories=Category::select('Name', 'Image')->get();
        return response()->json(["Categories"=>$Categories,"message"=>"Imported categories successfully"]);

    }
    public function ShowCategory(Request $request){

    }
}
