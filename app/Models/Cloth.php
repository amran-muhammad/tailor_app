<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cloth extends Model
{
    use HasFactory;

    protected $fillable = [
        'cloth_name',
        'price',
        'image',
        'image2',
        'description',
        'category_name',
        'status',
    ];
}
