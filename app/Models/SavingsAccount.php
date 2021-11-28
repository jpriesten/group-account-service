<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingsAccount extends Model
{
    use HasFactory;

    /**
     * Get the group that owns the account.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ITechGroup::class, 'groupCode', 'groupCode');
    }
}
