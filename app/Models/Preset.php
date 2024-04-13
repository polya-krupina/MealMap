<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preset extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function meals(){
        return $this->hasMany(Meal::class);
    }

    protected static function booted()
    {
        static::created(function ($preset) {
            $meals = [
                ['meal_type_id' => 1],
                ['meal_type_id' => 2],
                ['meal_type_id' => 3],
                ['meal_type_id' => 4],
            ];

            $preset->meals()->createMany($meals);
        });
    }

}
