<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function Products()
    {
        $Products = Product::select('Name', 'Description', 'Image_Product', 'Price_First', 'Price_Sale', 'id')->get();
        // ->where('category', 'Electronics')
        // ->orderBy('price', 'desc')
        // ->get();
        return response()->json(['Products' => $Products, 'message' => 'Imported products successfully '], 200);
    }
    // public function ShowProduct(Product $Product){
    //     $selectedProduct = $Product->select('Name', 'Description','Image_Product','Price_First','Price_Sale','id')->first();
    //     return response()->json(["product"=>$Product,"message"=>"Product is seccessfully",$Product=>"Product"]);
    // }

    public function ShowProduct(string $id)
    {
        $Product = Product::find($id);
        $selectedProduct = $Product->select('Name', 'Description', 'Image_Product', 'Price_First', 'Price_Sale', 'id')
            ->where('id', $id)->first();
        return response()->json(["product" => $selectedProduct, "message" => "Product is seccessfully", "id" => $id]);
    }
    public function Categories()
    {
        $Categories = Category::select('Name', 'Image', 'id')->get();
        return response()->json(["Categories" => $Categories, "message" => "Imported categories successfully"]);
    }
    public function ShowCategory(string $id)
    {
        // dd($id);
        // $category_id = $request->post('category_id');        
        $products = DB::table('products as P')
            ->select('P.Name', 'P.Description', 'P.Price_Sale', 'P.Price_First', 'P.Image_Product', 'P.id', 'C.Name AS NameCategory')
            ->join('category_product as CP', 'CP.product_id', '=', 'P.id')
            ->join('categories as C', 'C.id', '=', 'CP.category_id')
            ->where('C.id', $id)
            ->get();

        return response()->json(["Productes" => $products, "Category" => $products[0]->NameCategory]);
    }
    public function searchIdCategories(Request $request)
    {
        $list = $request->post('list');
        $Products = Product::select('products.Name', 'products.Description', 'products.id', 'products.Image_Product', 'products.Price_First', 'products.Price_Sale')
            ->join('category_product as CP', 'products.id', '=', 'CP.Product_id')
            ->whereIn('CP.Category_id', $list)
            ->groupBy('products.Name', 'products.Description', 'products.id', 'products.Image_Product', 'products.Price_First', 'products.Price_Sale')
            ->get();
        return response()->json(["Products" => $Products, "list" => $list]);
    }
}
