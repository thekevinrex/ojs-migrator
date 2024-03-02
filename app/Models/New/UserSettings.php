<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    use HasFactory;

    protected $table = 'user_settings';

    protected $primaryKey = 'user_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
