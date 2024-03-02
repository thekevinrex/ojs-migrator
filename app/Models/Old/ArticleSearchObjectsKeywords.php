<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSearchObjectsKeywords extends Model
{
    use HasFactory;


    protected $table = 'article_search_object_keywords';

    protected $connection = 'old';
}
