<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     //
// }





namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
Use Illuminate\Support\Facades\Cache;
 use Laravel\Sanctum\HasApiTokens; //for api
 //use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;

   // use HasFactory, Notifiable, HasApiTokens; //For api
    //  use HasApiTokens, HasFactory, Notifiable;
    use HasApiTokens, Notifiable;  //for Api token bunu

    public $timestamps = false; //for data entry all edittext box
    protected $guarded = [];


}