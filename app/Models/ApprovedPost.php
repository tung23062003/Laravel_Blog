<?php

namespace App\Models;

use App\Models\Scopes\ApprovedPostScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class ApprovedPost extends Post
{
    use HasFactory;
    public $table = 'posts';
    
    protected static function booted(){
        static::addGlobalScope(new ApprovedPostScope);
    }
}
