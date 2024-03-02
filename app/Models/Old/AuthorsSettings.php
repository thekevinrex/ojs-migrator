<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorsSettings extends Model
{
    use HasFactory;

    protected $table = 'author_settings';

    protected $primaryKey = 'author_id';

    protected $connection = 'old';
}
