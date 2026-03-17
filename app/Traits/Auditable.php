<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            $model->recordActivity('created');
        });

        static::updated(function ($model) {
            $model->recordActivity('updated');
        });

        static::deleted(function ($model) {
            $model->recordActivity('deleted');
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->recordActivity('restored');
            });
        }
    }

    public function recordActivity(string $event): void
    {
        $description = $this->getActivityDescription($event);
        
        $userId = Auth::id();
        
        Log::info("AUDIT: {$description}", [
            'model' => static::class,
            'model_id' => $this->id,
            'event' => $event,
            'user_id' => $userId,
            'old_attributes' => $this->getOriginal(),
            'new_attributes' => $this->getAttributes(),
        ]);
    }

    protected function getActivityDescription(string $event): string
    {
        $modelName = class_basename(static::class);
        
        return match ($event) {
            'created' => "El usuario {$modelName} fue creado",
            'updated' => "El usuario {$modelName} fue actualizado",
            'deleted' => "El usuario {$modelName} fue eliminado",
            'restored' => "El usuario {$modelName} fue restaurado",
            default => "Evento {$event} en {$modelName}",
        };
    }
}
