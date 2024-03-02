<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSearchKeywords extends Model
{
    use HasFactory;

    protected $table = 'article_search_keyword_list';

    protected $connection = 'old';
}
