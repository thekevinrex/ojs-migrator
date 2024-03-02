<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionFiles extends Model
{
    use HasFactory;

    protected $table = 'submission_files';

    protected $primaryKey = 'submission_file_id';

    protected $connection = 'new';

    protected $guarded = [];

    public function settings()
    {
        return $this->hasMany(SubmissionFileSettings::class, 'submission_file_id', 'submission_file_id');
    }
}
