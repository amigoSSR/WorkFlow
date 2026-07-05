<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyReport extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'filename',
        'filepath',
        'period_start',
        'period_end',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeForPeriod($query, $start, $end)
    {
        return $query->where('period_start', $start)->where('period_end', $end);
    }
}
