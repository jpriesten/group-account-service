<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class ITechGroup extends Model
{
    use HasFactory;

    protected $primaryKey = 'groupCode';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'groupId',
        'groupCode',
        'groupRepPhone',
        'groupRepEmail'
    ];

    /**
     * Get the savings account associated with the group.
     */
    public function savingsAccount(): HasOne
    {
        return $this->hasOne(SavingsAccount::class, 'groupCode', 'groupCode');
    }

    /**
     * Get the operations account associated with the group.
     */
    public function operationsAccount(): HasOne
    {
        return $this->hasOne(OperationsAccount::class, 'groupCode', 'groupCode');
    }

    /**
     * Get the welfare account associated with the group.
     */
    public function welfareAccount(): HasOne
    {
        return $this->hasOne(WelfareAccount::class, 'groupCode', 'groupCode');
    }
}