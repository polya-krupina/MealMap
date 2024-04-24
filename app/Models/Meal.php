<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function dishes(){
        return $this->belongsToMany(Dish::class, 'dishes_meals');
    }

    public function meal_type(){
        return $this->belongsTo(MealType::class);
    }

    public function price(){
        $price = 0;
        foreach($this->dishes as $dish)
            $price += $dish->price;

        return $price;
    }
}
