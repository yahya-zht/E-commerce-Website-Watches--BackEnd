<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $fillable = [
        'Ref' ,
        'Name' ,
        'Email' ,
        'Telephone' ,
        'Address' ,
        'City' ,
        'Country' ,
    ];
    public function Products(){
        return $this->hasMany(Product::class);
    }
}
