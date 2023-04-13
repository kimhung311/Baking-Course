<?php

namespace App\Models\DiscountType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DiscountType\Traits\DiscountTypeRelationship;

class DiscountType extends Model
{
    use HasFactory;
    use DiscountTypeRelationship;

    protected $table = 'discount_types';

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
