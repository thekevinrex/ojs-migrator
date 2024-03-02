<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorsSettings extends Model
{
    use HasFactory;

    protected $table = 'author_settings';

    protected $primaryKey = 'author_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
