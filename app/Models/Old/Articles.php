<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'article_id';

    protected $connection = 'old';

    public function settings()
    {
        return $this->hasMany(ArticlesSettings::class, 'article_id', 'article_id');
    }

    public function galleys()
    {
        return $this->hasMany(ArticlesGalleys::class, 'article_id', 'article_id');
    }

    public function files()
    {
        return $this->hasMany(ArticlesFiles::class, 'article_id', 'article_id');
    }
}
