<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Promotion
 *
 * @property int $id
 * @property int $emp_id
 * @property string $old_designation
 * @property string $new_designation
 * @property int $old_salary
 * @property int $new_salary
 * @property Carbon $date_of_promotion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Employee $employee
 *
 * @package App\Models
 */
class Promotion extends Model
{
    protected $table = 'promotions';
    
    protected $casts = [
        'emp_id'     => 'int',
        'old_salary' => 'int',
        'new_salary' => 'int',
    ];
    
    protected $dates = [
        'date_of_promotion',
    ];
    
    protected $fillable = [
        'emp_id',
        'old_designation',
        'new_designation',
        'old_salary',
        'new_salary',
        'date_of_promotion',
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
