<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discount\Traits\DiscountRelationship;

class Discount extends Model
{
    use HasFactory;
    use DiscountRelationship;

    protected $table = 'discounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'discount_type_id',
        'code',
        'start_date',
        'end_date',
        'present',
        'description',
        'total',
    ];

}
