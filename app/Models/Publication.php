<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Publication
 * @package App\Models
 * @property string description
 */
class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_id',
        'image_id'
    ];

    public function previewImage()
    {
        return $this->belongsTo(Image::class,'image_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'publication_id');
    }

    public function dislikes()
    {
        return $this->hasMany(Dislike::class, 'publication_id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function lastComments()
    {
        return $this->comments()
            ->orderByDesc('created_at')
            ->limit(3)->get();
    }
}
