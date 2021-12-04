<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperITechGroup
 */
class ITechGroup extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'code',
        'name',
        'representativeFirstName',
        'representativePhone',
        'representativeEmail'
    ];

    /**
     * Get the savings account associated with the group.
     */
    public function savingsAccount(): HasOne
    {
        return $this->hasOne(SavingsAccount::class, 'grpCode', 'code');
    }

    /**
     * Get the operations account associated with the group.
     */
    public function operationsAccount(): HasOne
    {
        return $this->hasOne(OperationsAccount::class, 'grpCode', 'code');
    }

    /**
     * Get the welfare account associated with the group.
     */
    public function welfareAccount(): HasOne
    {
        return $this->hasOne(WelfareAccount::class, 'grpCode', 'code');
    }
}
