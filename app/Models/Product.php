<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'Ref',
        'Name',
        'Description',
        'Image_Product',
        'Price_Purchase',
        'Price_First',
        'Price_Sale',
        'Quantity',
        'Sales',
        'provider_id',
    ];
    public function Provider(){
        return $this->belongsTo(Provider::class);
    }
    public function Categories(){
        return $this->belongsToMany(Category::class);
    }
    public function Orders(){
        return $this->belongsToMany(Order::class)->withPivot('Quantity', 'Total_Price');
    }
}
