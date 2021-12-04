<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperOperationsAccount
 */
class OperationsAccount extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'codage',
        'name',
        'numcpt',
        'grpCode',
        'numcli',
        'accType',
        'initialBal',
        'applyComis',
        'isBlocked'
    ];

    /**
     * Get the group that owns the account.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ITechGroup::class, 'grpCode', 'code');
    }
}
