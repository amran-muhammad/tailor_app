<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'cloth_id',
        'tailor_id',
        'customer_id',
        'cloth_name',
        'type_of_sleeves',
        'sleeves',
        'type_of_neck',
        'neck',
        'waist',
        'bust',
        'length',
        'quantity',
        'delivered_to_name',
        'delivered_to_phone',
        'delivered_to_area',
        'delivered_to_house',
        'delivered_to_city',
        'delivered_to_state',
        'delivered_to_post_code',
        'delivered_to_country',
        'order_status',
        'order_date',
        'delivery_date'
    ];
    public function customer()
    {
        return $this->hasOne(User::class,'id','customer_id');
    }
    public function tailor()
    {
        return $this->hasOne(User::class,'id','tailor_id');
    }
    public function cloth()
    {
        return $this->hasOne(Cloth::class,'id','cloth_id');
    }

}
