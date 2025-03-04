<?php

namespace App\Models\Traits;

use App\LogFormatters\LogFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait HasLog
{
    protected static function bootHasLog(): void
    {
        static::created(function (Model $model) {
            self::logEvent($model, 'created', $model->getAttributes());
        });

        static::updated(function (Model $model) {
            $changes = $model->getChanges();
            if (!empty($changes)) {
                self::logEvent($model, 'updated', $changes);
            }
        });

        static::deleted(function (Model $model) {
            self::logEvent($model, 'deleted', ['id' => $model->id]);
        });

        static::retrieved(function (Model $model) {
            self::logEvent($model, 'retrieved', ['id' => $model->id]);
        });
    }

    private static function logEvent(Model $model, string $event, array $attributes = []): void
    {
        $modelName = class_basename($model);

        $channel = "logs/$modelName/$event.log";

        Log::build([
            'driver' => 'single',
            'path' => storage_path($channel),
            'level' => 'info',
            'tap' => [\App\LogFormatters\PostLogFormatter::class],
        ])->info(strtoupper($event) . " | Model: $modelName | Data: " . json_encode($attributes));
    }
}
