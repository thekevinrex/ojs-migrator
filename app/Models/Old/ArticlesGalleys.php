<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesGalleys extends Model
{
    use HasFactory;

    protected $table = 'article_galleys';

    protected $primaryKey = 'galley_id';

    protected $connection = 'old';

    public function file()
    {
        return $this->hasOne(ArticlesFiles::class, 'file_id', 'file_id');
    }
}
