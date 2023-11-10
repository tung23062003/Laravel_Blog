<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    public $fillable = ['tittle', 'content', 'slug', 'image', 'category_id', 'user_id'];

    public function getRouteKeyName(){
        return 'slug';
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
