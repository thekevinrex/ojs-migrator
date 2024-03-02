<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = 'submissions';

    protected $primaryKey = 'submission_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function publications()
    {
        return $this->hasMany(Publication::class, 'submission_id', 'submission_id');
    }

    public function files()
    {
        return $this->hasMany(SubmissionFiles::class, 'submission_id', 'submission_id');
    }
}
