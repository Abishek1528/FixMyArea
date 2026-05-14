<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'is_admin'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the issues reported by the user.
     */
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    /**
     * Get the issues upvoted by the user.
     */
    public function upvotedIssues()
    {
        return $this->belongsToMany(Issue::class, 'upvotes')->withTimestamps();
    }

    /**
     * Get the comments made by the user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
