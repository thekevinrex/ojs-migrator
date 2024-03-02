<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticlesSettings extends Model
{
    use HasFactory;


    protected $table = 'article_settings';

    protected $primaryKey = 'article_id';

    protected $connection = 'old';
}
