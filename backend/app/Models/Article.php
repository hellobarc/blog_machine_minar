<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'category_id',
        'slug',
        'meta_keyword',
        'meta_description',
        'page_title',
        'thumbnail',
        'custom_date',
        'author_id',
        'tags',
    ];
}
