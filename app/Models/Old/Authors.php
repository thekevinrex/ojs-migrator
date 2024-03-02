<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $primaryKey = 'author_id';

    protected $connection = 'old';

    public function settings()
    {
        return $this->hasMany(AuthorsSettings::class, 'author_id', 'author_id');
    }
}
