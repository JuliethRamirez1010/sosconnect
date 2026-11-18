<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PanicAlert extends Model
{
    protected $fillable = [
        'device_id',
        'patient_id',
        'message',
        'status',
        'attended_by',
        'attended_at',
        'resolved_at',
        'report',
        'severity',
        'symptoms',
        'triggered_at',
    ];

    protected function casts(): array
    {
        return [
            'triggered_at' => 'datetime',
            'attended_at' => 'datetime',
            'resolved_at' => 'datetime',
            'symptoms' => 'array',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function attendedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'attended_by');
    }
}
