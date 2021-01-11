<?php

namespace App\Core\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value)
    {
        if (!is_null($value))
            return Storage::disk('profiles')->url($value);
        else
            return NULL;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Content::class, 'likes', 'user_id', 'content_id');
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }
}
