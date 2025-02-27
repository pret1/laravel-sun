<?php

namespace App\Models\Traits;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

trait HasLog
{
//    protected static function bootHasLog(): void
//    {
//        static::created(function (Model $model) {
//            self::logEvent($model, 'created');
//        });
//
//        static::updated(function (Model $model) {
//            self::logEvent($model, 'updated', $model->getOriginal());
//        });
//
//        static::deleted(function (Model $model) {
//            self::logEvent($model, 'deleted', $model->getOriginal());
//        });
//
//        static::restored(function (Model $model) {
//            self::logEvent($model, 'restored');
//        });
//    }

    protected static function bootHasLog(): void
    {
        static::registerLoggingEvent('created');
        static::registerLoggingEvent('updated');
        static::registerLoggingEvent('deleted');
        static::registerLoggingEvent('restored');
    }

    private static function registerLoggingEvent(string $event): void
    {
        if (self::hasEventListener(static::class, $event)) {
            return;
        }

        static::$event(function (Model $model) use ($event) {
            self::logEvent($model, $event, $event === 'updated' ? $model->getOriginal() : []);
        });
    }

    private static function hasEventListener(string $modelClass, string $event): bool
    {
        $dispatcher = Event::getFacadeRoot();
        $listeners = $dispatcher->getListeners("eloquent.{$event}: {$modelClass}");

        return !empty($listeners);
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
