<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'subject_type',
        'subject_id',
        'event',
        'properties',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        $class = $this->subject_type;
        return $class::find($this->subject_id);
    }

    public static function log(string $description, ?Model $model = null, ?string $event = null, array $properties = []): self
    {
        return static::create([
            'user_id' => auth()->id(),
            'description' => $description,
            'subject_type' => $model ? get_class($model) : null,
            'subject_id' => $model?->getKey(),
            'event' => $event,
            'properties' => $properties,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
