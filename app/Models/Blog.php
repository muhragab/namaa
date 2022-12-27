<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Blog
 * @package App\Models
 * @version December 26, 2022, 10:12 am UTC
 *
 * @property string $image
 * @property string $title
 * @property string $publish_date
 * @property boolean $status
 */
class Blog extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'blogs';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'image',
        'title',
        'content',
        'publish_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'image' => 'string',
        'title' => 'string',
        'content' => 'string',
        'publish_date' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required|image',
        'title' => 'required',
        'content' => 'required',
        'publish_date' => 'required|date',
        'status' => 'required'
    ];


}
