<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image',  'date', 'travel_id', 'time_start', 'time_arrived', 'location', 'description'];

    /**
     * Get the travels that owns the Step
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }

    /**
     * Get all of the notes for the Step
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
