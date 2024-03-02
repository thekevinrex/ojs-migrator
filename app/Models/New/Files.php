<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $table = 'files';

    protected $primaryKey = 'file_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
