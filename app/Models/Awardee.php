<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Awardee
 *
 * @property int $id
 * @property int $user_id
 * @property int $award_id
 * @property Carbon $date
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Award $award
 * @property User $user
 *
 * @package App\Models
 */
class Awardee extends Model
{
    protected $table = 'awardees';
    
    protected $casts = [
        'user_id'  => 'int',
        'award_id' => 'int',
    ];
    
    protected $dates = [
        'date',
    ];
    
    protected $fillable = [
        'user_id',
        'award_id',
        'date',
        'reason',
    ];
    
    public function award()
    {
        return $this->belongsTo(Award::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
