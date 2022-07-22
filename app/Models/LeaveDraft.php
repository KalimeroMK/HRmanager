<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LeaveDraft
 *
 * @property int $id
 * @property string $subject
 * @property string $body
 * @property int $leave_type_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property LeaveType $leave_type
 *
 * @package App\Models
 */
class LeaveDraft extends Model
{
    protected $table = 'leave_drafts';
    
    protected $casts = [
        'leave_type_id' => 'int',
    ];
    
    protected $fillable = [
        'subject',
        'body',
        'leave_type_id',
    ];
    
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
