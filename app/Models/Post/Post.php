<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post\Traits\PostRelationship;

class Post extends Model
{
    use HasFactory;
    use PostRelationship;

    protected $table = 'posts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'post_type_id',
        'description',
        'slug',
        'order',
        'status',
        'published_at',
    ];

}
