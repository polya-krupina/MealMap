<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function kids(){
        return $this->hasMany(Kid::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
