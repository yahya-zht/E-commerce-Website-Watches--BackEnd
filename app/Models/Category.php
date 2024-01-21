<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'Ref',
    //     'name',
    // ];
    public function Products(){
        return $this->belongsToMany(Product::class);
    }
}
