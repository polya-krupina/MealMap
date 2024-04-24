<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Template\Template;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function preset(){
        return $this->belongsTo(Preset::class);
    }

    public function get_price(){
        $price = 0;
        foreach ($this->preset->meals as $meal){
            $price += $meal->price();
        }

        return $price;
    }
}
