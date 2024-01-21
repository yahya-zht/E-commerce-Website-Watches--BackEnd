<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'Ref',
    //     'name',
    //     'description',
    //     'Image_Product'];
    public function Products(){
        return $this->belongsToMany(Product::class);
    }
}
