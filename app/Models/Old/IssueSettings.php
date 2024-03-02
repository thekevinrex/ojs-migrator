<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueSettings extends Model
{
    use HasFactory;

    protected $table = 'issue_settings';

    protected $connection = 'old';

    protected $guarded = [];

    public $timestamps = false;

    public function issue()
    {
        return $this->belongsTo(Issues::class, 'issue_id', 'issue_id');
    }
}
