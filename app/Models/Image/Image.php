<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image\Traits\ImageRelationship;

class Image extends Model
{
    use HasFactory;
    use ImageRelationship;

    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'is_show',
        'imageable_id',
        'imageable_type',
    ];
    
}
