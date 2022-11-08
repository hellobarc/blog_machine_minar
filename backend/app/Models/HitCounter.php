<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HitCounter extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'article_id',
        'page_name',
        'ip_address',
        'staying_time',
        'country',
        'city',
    ];
}
