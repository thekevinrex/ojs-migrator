<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionFileSettings extends Model
{
    use HasFactory;

    protected $table = 'submission_file_settings';

    protected $primaryKey = 'submission_file_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;
}
