<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'documentable_id',
        'documentable_type',
        'type',
        'file_path',
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
}