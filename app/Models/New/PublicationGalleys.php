<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationGalleys extends Model
{
    use HasFactory;


    protected $table = 'publication_galleys';

    protected $primaryKey = 'galley_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
