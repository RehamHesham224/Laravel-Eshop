<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'total_price',
        'payment_mode',
        'total_id',
        'status',
        'tracking_no',
        'message',
    ];
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
