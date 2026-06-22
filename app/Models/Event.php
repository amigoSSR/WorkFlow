<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'start_date',
        'end_date',
        'location',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /**
     * The user who created the event.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope: only upcoming events (today or future).
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now()->toDateString())
                     ->orderBy('start_date');
    }

    /**
     * Get the Tailwind color classes for this event type.
     */
    public function colorClasses(): array
    {
        return match($this->type) {
            'meeting'  => ['bg' => 'bg-secondary/10', 'text' => 'text-secondary', 'border' => 'border-secondary', 'dot' => 'bg-secondary'],
            'deadline' => ['bg' => 'bg-tertiary/10',  'text' => 'text-tertiary',  'border' => 'border-tertiary',  'dot' => 'bg-tertiary'],
            'sprint'   => ['bg' => 'bg-primary/10',   'text' => 'text-primary',   'border' => 'border-primary',   'dot' => 'bg-primary'],
            'critical' => ['bg' => 'bg-error/10',     'text' => 'text-error',     'border' => 'border-error',     'dot' => 'bg-error'],
            default    => ['bg' => 'bg-outline/10',   'text' => 'text-outline',   'border' => 'border-outline',   'dot' => 'bg-outline'],
        };
    }
}
