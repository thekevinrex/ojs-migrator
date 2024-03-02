<?php

namespace App\Models\New;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';

    protected $primaryKey = 'publication_id';

    protected $connection = 'new';

    protected $guarded = [];

    public $timestamps = false;

    public function settings()
    {
        return $this->hasMany(PublicationSettings::class, 'publication_id', 'publication_id');
    }

    public function galleys()
    {
        return $this->hasMany(PublicationGalleys::class, 'publication_id', 'publication_id');
    }
}
