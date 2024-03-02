<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSearchObjects extends Model
{
    use HasFactory;

    protected $table = 'article_search_objects';

    protected $connection = 'old';
}
