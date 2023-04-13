<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\Traits\OrderRelationship;

class Order extends Model
{
    use HasFactory;
    use OrderRelationship;

    protected $table = 'orders';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_course_id',
        'discount_id',
        'before_price',
        'after_price',
        'payment_method',
        'status',
        'amount',
    ];
  
}
