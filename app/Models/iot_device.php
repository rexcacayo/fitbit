<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class iot_device
 * @package App\Models
 * @version June 2, 2019, 2:31 pm UTC
 *
 * @property string ipServer
 * @property string fiwareService
 * @property string fiwarePath
 * @property string device_id
 * @property string entity_name
 * @property string entity_type
 */
class iot_device extends Model
{
    use SoftDeletes;

    public $table = 'iot_devices';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'device_id',
        'entity_name',
        'entity_type'
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
        'device_id' => 'string',
        'entity_name' => 'string',
        'entity_type' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'fiwarePath' => 'required',
        'device_id' => 'required',
        'entity_type' => 'required'
    ];

    public function atributoIOT()

    {

        return $this->hasMany('App\Models\iot_device_attribute');

    }




}
