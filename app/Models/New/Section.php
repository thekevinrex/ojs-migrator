<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;


    protected $table = 'sections';

    protected $primaryKey = 'section_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function settings()
    {
        return $this->hasMany(SectionSettings::class, 'section_id', 'section_id');
    }
}
