<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Award
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Awardee[] $awardees
 *
 * @package App\Models
 */
class Award extends Model
{
    protected $table = 'awards';
    
    protected $fillable = [
        'name',
        'description',
    ];
    
    public function awardees()
    {
        return $this->hasMany(Awardee::class);
    }
}
