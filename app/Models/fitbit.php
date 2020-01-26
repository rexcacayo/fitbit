<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class fitbit
 * @package App\Models
 * @version June 19, 2019, 5:42 pm UTC
 *
 * @property string token
 * @property string user_id
 * @property string name
 * @property string datebirth
 * @property string age
 */
class fitbit extends Model
{
    use SoftDeletes;

    public $table = 'fitbits';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'token',
        'user_id',
        'name',
        'datebirth',
        'age',
        'continent',
        'country',
        'city',
        'dock',
        'avilable'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'token' => 'string',
        'user_id' => 'string',
        'name' => 'string',
        'datebirth' => 'string',
        'age' => 'string',
        'continent' => 'String',
        'country' => 'String',
        'city' => 'String',
        'dock' => 'String',
        'avilable' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'token' => 'required',
        'user_id' => 'required'
    ];

    
}
