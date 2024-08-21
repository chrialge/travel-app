<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    protected $fillable = ['step_id', 'slug', 'customer_name', 'customer_lastname', 'customer_email', 'note'];
    use HasFactory;

    /**
     * Get the steps that owns the Note
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function steps(): BelongsTo
    {
        return $this->belongsTo(Step::class, 'foreign_key', 'other_key');
    }
}
