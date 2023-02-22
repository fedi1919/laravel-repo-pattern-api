<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand_id',
        'title',
        'content',
        'price',
        'rate'
    ];

    /*
     * The user of the post
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /*
     * the Brand of the Post
     */
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    /*
     * The categories of a post
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }


}
