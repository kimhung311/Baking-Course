<?php

namespace App\Models\PostType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostType\Traits\PostTypeRelationship;
class PostType extends Model
{
    use HasFactory;
    use PostTypeRelationship;

    protected $table = 'post_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];
    
}
