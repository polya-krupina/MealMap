<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kindergarten extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function groups(){
        return $this->hasMany(Group::class);
    }
}
