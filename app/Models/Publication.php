<?php

namespace App\Models;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Publication
 * @package App\Models
 * @property string description
 */
class Publication extends Model
{
    use HasFactory, HasComments;

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

    public function lastComments()
    {
        return $this->comments()
            ->orderByDesc('created_at')
            ->limit(3)->get();
    }

    public function childComments(array $data)
    {
        return Comment::where([
            ['commentable_id', $data['commentable_id']],
            ['commentable_type',  $data['commentable_type']]
        ])
            ->limit(4)
            ->get();
    }

    public function hasLike(User $user)
    {
        return self::likes()->whereUserId($user->id)->exists();
    }

    public function hasDislike(User $user)
    {
        return self::dislikes()->whereUserId($user->id)->exists();
    }
}
