<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
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

    
    public function getPageDescriptionAttribute($value){
        return Str::of($value)->words(20, ' >>>');

    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('l jS F');
    }
}
