<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $connection = 'old';

    public $timestamps = false;

    public function roles()
    {
        return $this->hasMany(Role::class, 'user_id', 'user_id');
    }

    public function settings()
    {
        return $this->hasMany(UserSettings::class, 'user_id', 'user_id');
    }
}
