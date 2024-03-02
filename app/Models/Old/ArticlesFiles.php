<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesFiles extends Model
{
    use HasFactory;

    protected $table = 'article_files';

    protected $primaryKey = 'file_id';

    protected $connection = 'old';
}
