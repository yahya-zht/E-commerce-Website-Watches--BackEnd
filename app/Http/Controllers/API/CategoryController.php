<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories=Category::all();
        return response()->json(["Categories"=>$Categories,"Status"=>"Imported categories successfully"]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' =>'required',
            // 'Image' =>'required|image',
        ]);
        if ($request->hasFile('Image')) {
            $file=$request->file('Image');
            $filename=$file->getClientOriginalExtension();
            $imageName=Str::random().'.'.$filename;
            Storage::disk('public')->makeDirectory('Images/Category');
            Storage::disk('public')->put('Images/Category/'. $imageName, file_get_contents($file));
            Category::create($request->post()+['Image'=>$imageName]);
        }
        else{
            Category::create($request->post());
        }
        return response()->json(["status"=>"Success Added Category "]);
    }


    public function show(Category $Category)
    {
        // $Category->load('provider');
        return response()->json(["Category"=>$Category]);
    }

    public function update(Request $request, Category $Category)
    {
        $request->validate([
            // 'Name' =>'required',
            // 'Image' =>'required|image',
        ]);
        if ($request->hasFile('Image')) {
            if($Category->Image){
                $exist=Storage::disk('public')->exists("Images/Category/{$Category->Image}");
                if($exist){
                    Storage::disk('public')->delete("Images/Category/{$Category->Image}");
                }
            }
            $file=$request->file('Image');
            $filename=$file->getClientOriginalExtension();
            $imageName=Str::random().'.'.$filename;
            Storage::disk('public')->makeDirectory('Images/Category');
            Storage::disk('public')->put('Images/Category/'. $imageName, file_get_contents($file));
            $Category->Image=$imageName;
        }
        $Category->fill($request->post())->update();
        $Category->save();
        return response()->json(["status"=>"Success Updated Category "]);
    }

    public function destroy(Category $Category)
    {
        if($Category->Image){
            $exist=Storage::disk('public')->exists("Images/Category/{$Category->Image}");
            if($exist){
                Storage::disk('public')->delete("Images/Category/{$Category->Image}");          
            }
        }
        $Category->delete();
        return response()->json(["status"=>"Success Deleted Category "]);
    }
}
