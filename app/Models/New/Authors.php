<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $primaryKey = 'author_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function settings()
    {
        return $this->hasMany(AuthorsSettings::class, 'author_id', 'author_id');
    }
}
