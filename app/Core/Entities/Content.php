<?php

namespace App\Core\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'image',
        'link'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
    ];

    public function getImageAttribute($value)
    {
        if (!is_null($value))
            return Storage::disk('contents')->url($value);
        else
            return NULL;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'content_id', 'user_id');
    }
}
