<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionSearchObjects extends Model
{
    use HasFactory;


    protected $connection = 'new';

    protected $table = 'submission_search_objects';
}
