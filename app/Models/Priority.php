<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    const LOW = 'LOW';// alacsony
    const MEDIUM = 'MEDIUM';// közepes
    const HIGH = 'HIGH';// magas
    const URGENT = 'URGENT';// sürgős

    const STATUSES = [
        self::LOW,
        self::MEDIUM,
        self::HIGH,
        self::URGENT,
    ];

    protected $fillable = [
        'name',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
