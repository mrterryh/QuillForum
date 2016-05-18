<?php

namespace Quill;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'body', 'parent_id', 'poster_id',
        'status', 'slug', 'title'
    ];

    /**
     * Returns the user who created the post.
     * 
     * @return object
     */
    public function poster()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns all posts in the thread.
     * 
     * @return object
     */
    public function posts()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}