<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueSettings extends Model
{
    use HasFactory;

    protected $table = 'issue_settings';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function issue()
    {
        return $this->belongsTo(Issues::class, 'issue_id', 'issue_id');
    }
}
