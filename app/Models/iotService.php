<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class iotService
 * @package App\Models
 * @version June 1, 2019, 5:02 pm UTC
 *
 * @property string fiwareService
 * @property string fiwarePath
 * @property string apikey
 * @property string cbroker
 * @property string entity_type
 * @property string resource
 */
class iotService extends Model
{
    use SoftDeletes;

    public $table = 'iot_services';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'apikey',
        'cbroker',
        'entity_type',
        'resource'
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
        'apikey' => 'string',
        'cbroker' => 'string',
        'entity_type' => 'string',
        'resource' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'resource' => 'required',
        'apikey' => 'required',
        'entity_type' => 'required',
        'fiwarePath' => 'required',

    ];


}
