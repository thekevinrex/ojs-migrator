<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionSettings extends Model
{
    use HasFactory;

    protected $table = 'section_settings';

    protected $connection = 'old';
}
