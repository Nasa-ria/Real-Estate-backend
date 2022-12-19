<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'name',
        'description',
        'location',
        'images',
        'profileImages',
        'amenities',
        'facilities',
        'price',
        'size',
        'furnished',
        'published_at'
    ];


    protected $casts = [
        'images' => 'array',
        'amenities' => 'array',
        'facilities' => 'array'

    ];

}
