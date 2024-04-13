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
}
