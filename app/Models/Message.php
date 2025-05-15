<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    public function getIsSelfAttribute(): bool
    {
        return (int) $this->profile_id === (int) auth()->user()->profile->id;
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }
}
