<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function roles()
    {
        return $this->hasMany(UserGroup::class, 'user_id', 'user_id');
    }

    public function settings()
    {
        return $this->hasMany(UserSettings::class, 'user_id', 'user_id');
    }
}
