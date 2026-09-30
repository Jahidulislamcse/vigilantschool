<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'guardian_name',
        'guardian_email',
        'guardian_phone',
        'child_name',
        'child_age',
        'class_id',
        'message',
        'status',
        'admin_notes',
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
