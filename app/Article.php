<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    protected $fillables = [
        "title", "content"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
