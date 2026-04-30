<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    public $timestamps = false; //for data entry all edittext box
    protected $guarded = [];
}
