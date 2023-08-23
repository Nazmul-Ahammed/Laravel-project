<?php
// app/Post.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'image'];

    public function getExcerptAttribute()
    {
        return substr($this->content, 0, 100) . '...';
    }
}
