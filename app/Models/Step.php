<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;

    /**
     * Get the travels that owns the Step
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class);
    }
}
