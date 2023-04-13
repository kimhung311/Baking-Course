<?php

namespace App\Models\CourseDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseDetail\Traits\CourseDetailRelationship;

class CourseDetail extends Model
{
    use HasFactory;
    use CourseDetailRelationship;

    const DIFFICULTY_BASIC = 1;
    const DIFFICULTY_MEDIUM = 2;
    const DIFFICULTY_ADVANCE = 3;

    protected $table = 'course_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'course_detail_type_id',
        'difficulty',
        'icon',
        'is_updated',
        'price',
        'lesson_count',
        'total_user',
        'rest_user',
        'place',
    ];

}
