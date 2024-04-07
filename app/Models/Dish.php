<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function meals(){
        return $this->belongsToMany(MealType::class, "meal_types_dishes");
    }

    public function products(){
        return $this->belongsToMany(Product::class,"dishes_products");
    }
}
