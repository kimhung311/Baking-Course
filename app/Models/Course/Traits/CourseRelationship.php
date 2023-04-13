<?php

namespace App\Models\Course\Traits;

use App\Models\Image\Image;

trait CourseRelationship
{
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
