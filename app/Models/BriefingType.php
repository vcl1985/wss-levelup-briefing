<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BriefingType extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'schema', 'active', 'sort_order'];

    protected $casts = [
        'schema' => 'array',
        'active' => 'boolean',
    ];

    public function submissions()
    {
        return $this->hasMany(BriefingSubmission::class);
    }
}