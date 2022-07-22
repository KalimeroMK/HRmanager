<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingInvite
 *
 * @property int $id
 * @property int $user_id
 * @property int $program_id
 * @property string $description
 * @property Carbon $date_from
 * @property Carbon $date_to
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TrainingProgram $training_program
 * @property User $user
 *
 * @package App\Models
 */
class TrainingInvite extends Model
{
    protected $table = 'training_invites';
    
    protected $casts = [
        'user_id'    => 'int',
        'program_id' => 'int',
    ];
    
    protected $dates = [
        'date_from',
        'date_to',
    ];
    
    protected $fillable = [
        'user_id',
        'program_id',
        'description',
        'date_from',
        'date_to',
    ];
    
    public function training_program()
    {
        return $this->belongsTo(TrainingProgram::class, 'program_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
