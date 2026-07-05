<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HouseRule extends Model
{
    use HasFactory;

    protected $table = 'house_rules';

    protected $fillable = [
        'judul_rule',
        'deskripsi_rule',
        'kategori',
        'dibuat_oleh',
        'order_column',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_column' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who created the house rule.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    /**
     * Scope for active rules.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordering.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_column')->orderBy('created_at', 'desc');
    }

    /**
     * Search scope.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('judul_rule', 'like', "%{$search}%")
              ->orWhere('deskripsi_rule', 'like', "%{$search}%")
              ->orWhere('kategori', 'like', "%{$search}%");
        });
    }
}