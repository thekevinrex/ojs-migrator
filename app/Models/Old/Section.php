<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'sections';

    protected $connection = 'old';

    public function settings()
    {
        return $this->hasMany(SectionSettings::class, 'section_id', 'section_id');
    }
}
