<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'Ref',
        'Name',
        'Telephone',
        'Total_Price',
        'Email',
        'Address',
        'City',
        'Country'];
    public function Products(){
        return $this->belongsToMany(Product::class)->withPivot('Quantity', 'Total_Price');
    }
}
