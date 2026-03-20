<?php

namespace App\Traits;

use App\Models\Activity;

trait Auditable
{
    public static function bootAuditable(): void
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
        Activity::log(
            description: $this->getActivityDescription($event),
            model: $this,
            event: $event,
            properties: [
                'old_attributes' => $this->getOriginal(),
                'new_attributes' => $this->getAttributes(),
            ]
        );
    }

    protected function getActivityDescription(string $event): string
    {
        $modelName = class_basename(static::class);

        return match ($event) {
            'created' => "Registro de {$modelName} creado",
            'updated' => "Registro de {$modelName} actualizado",
            'deleted' => "Registro de {$modelName} eliminado",
            'restored' => "Registro de {$modelName} restaurado",
            default => "Evento {$event} en {$modelName}",
        };
    }
}
