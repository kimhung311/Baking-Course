<?php

namespace App\Models\CourseDetailType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CountDetailType\Traits\CourseDetailTypeRelationship;

class CourseDetailType extends Model
{
    use HasFactory;
    use CourseDetailTypeRelationship;
    
    protected $table = 'course_detail_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];
    
}
