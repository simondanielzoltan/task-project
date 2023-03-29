<?php

namespace App\Models;

use App\Models\User;
use App\Models\Priority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'deadline_at',
        'description',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $model->created_by = $model->created_by ?? auth()->user()->id ?? null;
        });
    }

    public function state(): BelongsTo
    {
        return $this->BelongsTo(State::class);
    }

    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function createdByUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function assignedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
}
