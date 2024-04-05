<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
