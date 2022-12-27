<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Subscriber
 * @package App\Models
 * @version December 25, 2022, 2:30 pm UTC
 *
 * @property string $name
 * @property string $username
 * @property string $password
 * @property boolean $status
 * @property string $pc_id
 * @property string $type
 */
class Subscriber extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'subscribers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'username',
        'password',
        'status',
        'pc_id',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'username' => 'string',
        'password' => 'string',
        'status' => 'boolean',
        'pc_id' => 'string',
        'type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'username' => 'required|unique',
        'password' => 'required',
        'status' => 'required|in:1,0',
        'pc_id' => 'nullable',
        'type' => 'required|in:admin,subscriber'
    ];

    
}
