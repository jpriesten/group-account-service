<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\GroupMember
 *
 * @mixin IdeHelperGroupMember
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GroupMember whereUpdatedAt($value)
 */
	class IdeHelperGroupMember extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ITechGroup
 *
 * @mixin IdeHelperITechGroup
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $representativeFirstName
 * @property string $representativePhone
 * @property string $representativeEmail
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\OperationsAccount|null $operationsAccount
 * @property-read \App\Models\SavingsAccount|null $savingsAccount
 * @property-read \App\Models\WelfareAccount|null $welfareAccount
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup find($id, $columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereRepresentativeEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereRepresentativeFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereRepresentativePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ITechGroup whereUpdatedAt($value)
 */
	class IdeHelperITechGroup extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OperationsAccount
 *
 * @mixin IdeHelperOperationsAccount
 * @property int $id
 * @property string $codage
 * @property string $name
 * @property string $numcpt
 * @property string $grpCode
 * @property string|null $numcli
 * @property string $accType
 * @property float $initialBal
 * @property string $applyComis
 * @property string $isBlocked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ITechGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereAccType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereApplyComis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereCodage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereGrpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereInitialBal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereNumcli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereNumcpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OperationsAccount whereUpdatedAt($value)
 */
	class IdeHelperOperationsAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SavingsAccount
 *
 * @mixin IdeHelperSavingsAccount
 * @property int $id
 * @property string $codage
 * @property string $name
 * @property string $numcpt
 * @property string $grpCode
 * @property string|null $numcli
 * @property string $accType
 * @property float $initialBal
 * @property string $applyComis
 * @property string $isBlocked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ITechGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereAccType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereApplyComis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereCodage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereGrpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereInitialBal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereNumcli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereNumcpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingsAccount whereUpdatedAt($value)
 */
	class IdeHelperSavingsAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WelfareAccount
 *
 * @mixin IdeHelperWelfareAccount
 * @property int $id
 * @property string $codage
 * @property string $name
 * @property string $numcpt
 * @property string $grpCode
 * @property string|null $numcli
 * @property string $accType
 * @property float $initialBal
 * @property string $applyComis
 * @property string $isBlocked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ITechGroup $group
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereAccType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereApplyComis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereCodage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereGrpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereInitialBal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereIsBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereNumcli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereNumcpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WelfareAccount whereUpdatedAt($value)
 */
	class IdeHelperWelfareAccount extends \Eloquent {}
}

