<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedArticles extends Model
{
    use HasFactory;


    protected $table = 'published_articles';

    protected $connection = 'old';


    public function article()
    {
        return $this->hasOne(Articles::class, 'article_id', 'article_id');
    }
}
