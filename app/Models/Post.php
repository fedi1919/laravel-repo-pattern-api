<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'price',
        'rate'
    ];

    /*
     * Get the user of the post
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /*
     * Get the categories of a post
     */
    public function categories() {
        return $this->belongsToMany(Category::class);
    }


}
