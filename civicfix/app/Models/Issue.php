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
    ];

    /**
     * Get the user that reported the issue.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
