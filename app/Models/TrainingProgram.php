<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrainingProgram
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|TrainingInvite[] $training_invites
 *
 * @package App\Models
 */
class TrainingProgram extends Model
{
    protected $table = 'training_programs';
    
    protected $fillable = [
        'name',
        'description',
    ];
    
    public function training_invites()
    {
        return $this->hasMany(TrainingInvite::class, 'program_id');
    }
}
