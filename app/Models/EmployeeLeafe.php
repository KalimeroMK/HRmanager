<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeeLeafe
 *
 * @property int $id
 * @property int $user_id
 * @property int $tl_id
 * @property int $manager_id
 * @property int $leave_type_id
 * @property Carbon $date_from
 * @property Carbon $date_to
 * @property Carbon $from_time
 * @property Carbon $to_time
 * @property string $days
 * @property int $status
 * @property string $remarks
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property LeaveType $leave_type
 * @property User $user
 *
 * @package App\Models
 */
class EmployeeLeafe extends Model
{
    protected $table = 'employee_leaves';
    
    protected $casts = [
        'user_id'       => 'int',
        'tl_id'         => 'int',
        'manager_id'    => 'int',
        'leave_type_id' => 'int',
        'status'        => 'int',
    ];
    
    protected $dates = [
        'date_from',
        'date_to',
        'from_time',
        'to_time',
    ];
    
    protected $fillable = [
        'user_id',
        'tl_id',
        'manager_id',
        'leave_type_id',
        'date_from',
        'date_to',
        'from_time',
        'to_time',
        'days',
        'status',
        'remarks',
        'reason',
    ];
    
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
