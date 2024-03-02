<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;


    protected $table = 'issues';

    protected $primaryKey = 'issue_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function issueSettings()
    {
        return $this->hasMany(IssueSettings::class, 'issue_id', 'issue_id');
    }
}
