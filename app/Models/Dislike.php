<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dislike
 * @package App\Models
 * @property integer user_id
 * @property integer publication_id
 *
 * fixme Убрать дизлайк, сделать просто систему отношения к публикации,
 *  в которой будет флаг для определения лайк или дизлайк
 *  При нажатии на кнопку просто менять лайк или нет.
 */
class Dislike extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_id',
        'user_id'
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
