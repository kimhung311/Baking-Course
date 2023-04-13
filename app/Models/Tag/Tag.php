<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag\Traits\TagRelationship;

class Tag extends Model
{
    use HasFactory;
    use TagRelationship;

    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tagable_id',
        'tagable_type',
    ];
    
}
