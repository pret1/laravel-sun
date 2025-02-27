<?php

namespace App\Models\Traits;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;

trait HasLog
{
    protected static function booted(): void
    {
        static::created(function (Model $model) {
            self::logEvent($model, 'created');
        });

        static::updated(function (Model $model) {
            self::logEvent($model, 'updated', $model->getOriginal());
        });

        static::deleted(function (Model $model) {
            self::logEvent($model, 'deleted', $model->getOriginal());
        });

        static::restored(function (Model $model) {
            self::logEvent($model, 'restored');
        });
    }

    private static function logEvent(Model $model, string $event, array $oldData = null): void
    {
        Log::create([
            'model' => get_class($model),
            'event' => $event,
            'old_data' => $oldData,
            'new_data' => $model->toArray(),
        ]);
    }
}
