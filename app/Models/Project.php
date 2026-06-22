<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'category',
        'status',
        'priority',
        'deadline',
        'budget',
        'document_path',
        'reference_links',
        'max_members',
        'created_by'
    ];

    /**
     * Get the user who created the project.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the users that belong to the project.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the roadmaps for the project.
     */
    public function roadmaps()
    {
        return $this->hasMany(Roadmap::class);
    }

    /**
     * Get the milestones for the project.
     */
    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    /**
     * Get the links for the project.
     */
    public function projectLinks()
    {
        return $this->hasMany(ProjectLink::class);
    }
}
