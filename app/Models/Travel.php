<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'slug', 'date_start', 'date_finish', 'image', 'content'];

    protected $searchable = [
        'name',
        'date_start',
        'date_finish'
    ];

    /**
     * Get the user that owns the Travel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the steps for the Travel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
