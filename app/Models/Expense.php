<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Expense
 *
 * @property int $id
 * @property int $user_id
 * @property string $item
 * @property string $purchase_from
 * @property Carbon $date_of_purchase
 * @property int $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 *
 * @package App\Models
 */
class Expense extends Model
{
    protected $table = 'expenses';
    
    protected $casts = [
        'user_id' => 'int',
        'amount'  => 'int',
    ];
    
    protected $dates = [
        'date_of_purchase',
    ];
    
    protected $fillable = [
        'user_id',
        'item',
        'purchase_from',
        'date_of_purchase',
        'amount',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
