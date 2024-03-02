<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionSettings extends Model
{
    use HasFactory;


    protected $table = 'section_settings';

    protected $primaryKey = 'section_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
