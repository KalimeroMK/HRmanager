<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HolidayFilename
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class HolidayFilename extends Model
{
    protected $table = 'holiday_filenames';
    
    protected $dates = [
        'date',
    ];
    
    protected $fillable = [
        'name',
        'description',
        'date',
    ];
}
