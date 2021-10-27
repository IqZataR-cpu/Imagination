<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * @package App\Models
 *  @property integer user_id
 *  @property integer publication_id
 */
class Like extends Model
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
