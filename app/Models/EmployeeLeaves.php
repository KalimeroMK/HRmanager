<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\EmployeeLeaves
 *
 * @property int $id
 * @property int $user_id
 * @property int $tl_id
 * @property int $manager_id
 * @property int $leave_type_id
 * @property string $date_from
 * @property string $date_to
 * @property string $from_time
 * @property string $to_time
 * @property string $days
 * @property int $status 0 = Unapproved, 1 = Approved
 * @property string $remarks
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read LeaveType|null $leaveType
 * @property-read \App\User $user
 * @method static Builder|EmployeeLeaves newModelQuery()
 * @method static Builder|EmployeeLeaves newQuery()
 * @method static Builder|EmployeeLeaves query()
 * @method static Builder|EmployeeLeaves whereCreatedAt($value)
 * @method static Builder|EmployeeLeaves whereDateFrom($value)
 * @method static Builder|EmployeeLeaves whereDateTo($value)
 * @method static Builder|EmployeeLeaves whereDays($value)
 * @method static Builder|EmployeeLeaves whereFromTime($value)
 * @method static Builder|EmployeeLeaves whereId($value)
 * @method static Builder|EmployeeLeaves whereLeaveTypeId($value)
 * @method static Builder|EmployeeLeaves whereManagerId($value)
 * @method static Builder|EmployeeLeaves whereReason($value)
 * @method static Builder|EmployeeLeaves whereRemarks($value)
 * @method static Builder|EmployeeLeaves whereStatus($value)
 * @method static Builder|EmployeeLeaves whereTlId($value)
 * @method static Builder|EmployeeLeaves whereToTime($value)
 * @method static Builder|EmployeeLeaves whereUpdatedAt($value)
 * @method static Builder|EmployeeLeaves whereUserId($value)
 * @mixin Eloquent
 */
class EmployeeLeaves extends Model
{
    public function leaveType(): HasOne
    {
        return $this->hasOne(LeaveType::class, 'id', 'leave_type_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
