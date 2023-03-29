<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    const LOGGED_IN = 'LOGGED_IN';// bejelentve
    const ADDED = 'ADDED';// hozzáadva valakihez
    const IN_PROGRESS = 'IN_PROGRESS'; // folyamatban
    const TESTING = 'TESTING'; // tesztelhető
    const DONE = 'DONE'; // kész

    const STATUSES = [
        self::LOGGED_IN,
        self::ADDED,
        self::IN_PROGRESS,
        self::TESTING,
        self::DONE,
    ];

    protected $fillable = [
        'name',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
