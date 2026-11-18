<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'document_id',
        'age',
        'room',
        'bed',
        'diagnosis',
        'admitted_at',
        'device_id',
        'blood_type',
        'conditions',
        'medications',
        'emergency_contact_name',
        'emergency_contact_phone',
        'assigned_nurse_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'age' => 'integer',
            'admitted_at' => 'date',
            'conditions' => 'array',
            'medications' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function panicAlerts(): HasMany
    {
        return $this->hasMany(PanicAlert::class);
    }

    public function assignedNurse(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_nurse_id');
    }
}
