<?php

namespace App\Models;


use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Page extends Model
{
    use HasFactory;
   

    protected $fillable= [
        'user_id',
        'page_name',
        'page_category',
        'page_description',
        
    ];

    public function getCreatedAtAttribute($value)
    {
       return Carbon::parse($value)->format('l jS F');
    }
   
  
    
}
