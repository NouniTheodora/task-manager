<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;

    // The required properties that must be sent
    protected $fillable = [
        'title',
        'is_done',
        'project_id'
    ];

    protected $casts = [
        'is_done' => 'boolean'
    ];

    protected $hidden = [
        'updated_at'
    ];

    // The booted() function is called only when an Eloquent model is instantiated
    // This method provides a place to register event listeners or perform other setup tasks
    // For this example, all the routes currently are protected by a basic auth
    // By using this function we can be sure that each authenticated user will ONLY access & modify his own data
    // By "his own data" we mean every task with a creator_id = Auth::id()
    protected static function booted(): void
    {
        static::addGlobalScope('creator', function (Builder $builder) {
            $builder->where('creator_id', Auth::id());
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'creator_id');
    }

    public function project(): BelongsTo
    {
        // We do not need to use the foreign key here, Laravel does it automatically due to the name convention
        return $this->belongsTo(Project::class);
    }
}
