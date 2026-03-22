<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BriefingSubmission extends Model
{
    protected $fillable = [
        'briefing_type_id', 'empresa', 'responsavel_nome',
        'responsavel_email', 'responsavel_contato', 'data', 'status', 'ip_address',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function briefingType()
    {
        return $this->belongsTo(BriefingType::class);
    }
}