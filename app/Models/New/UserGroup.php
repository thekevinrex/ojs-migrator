<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'user_user_groups';

    protected $primaryKey = 'user_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
