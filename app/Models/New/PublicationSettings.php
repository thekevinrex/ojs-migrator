<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationSettings extends Model
{
    use HasFactory;

    protected $table = 'publication_settings';

    protected $primaryKey = 'publication_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
