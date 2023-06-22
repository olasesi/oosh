<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageMember extends Model
{
    use HasFactory;

    public function getPageDescriptionAttribute($value){
        return  Str::of($value)->limit(40);
       ;
    }

    public function getCreatedAtAttribute($value)
    {
       return Carbon::parse($value)->format('l jS F');
   }
   
}
