<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'order_id',
        'tailor_id',
        'is_seen',
        'message',
        'title',
        'status'
    ];
    public function customer()
    {
        return $this->hasOne(User::class,'id','customer_id');
    }
    public function tailor()
    {
        return $this->hasOne(User::class,'id','tailor_id');
    }
}
