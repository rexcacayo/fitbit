<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class iot_device_attribute
 * @package App\Models
 * @version June 2, 2019, 2:41 pm UTC
 *
 * @property string name
 * @property string type
 * @property integer deviceAttr_id
 */
class iot_device_attribute extends Model
{
    use SoftDeletes;

    public $table = 'iot_device_attributes';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'type',
        'objective',
        'attr_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'type' => 'string',
        'objective' => 'string',
        'attr_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public function iotservice()

    {

        return $this->belongsTo('App\Models\iot_device');

    }




}
