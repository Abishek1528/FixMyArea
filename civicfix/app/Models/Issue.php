<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'status',
        'latitude',
        'longitude',
        'address',
        'image',
    ];

    /**
     * Get the user that reported the issue.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users that upvoted the issue.
     */
    public function upvoters()
    {
        return $this->belongsToMany(User::class, 'upvotes')->withTimestamps();
    }

    /**
     * Get the number of upvotes for the issue.
     */
    public function getUpvotesCountAttribute()
    {
        return $this->upvoters()->count();
    }

    /**
     * Get the comments for the issue.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
