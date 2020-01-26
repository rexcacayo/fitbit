<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class notify
 * @package App\Models
 * @version May 19, 2019, 4:45 pm UTC
 *
 * @property string ipServer
 * @property string fiwareService
 * @property string fiwarePath
 * @property string description
 */
class notify extends Model
{
    use SoftDeletes;

    public $table = 'notifies';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'type',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ipServer' => 'string',
        'fiwareService' => 'string',
        'fiwarePath' => 'string',
        'type' => 'string',
        'description' => 'string'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fiwarePath' => 'required',
        'description' => 'required'
    ];


}
