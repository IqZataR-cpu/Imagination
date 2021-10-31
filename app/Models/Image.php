<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class image
 * @package App\Models
 * @property string path
 * @property string disk
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'disk'
    ];
}
