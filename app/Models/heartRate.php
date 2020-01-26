<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class heartRate
 * @package App\Models
 * @version November 28, 2019, 9:10 am UTC
 *
 */
class heartRate extends Model
{
    //use SoftDeletes;

    public $table = 'urn_ngsi-Id_Zone_Zone';


    protected $dates = [];



    public $fillable = [


    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'recvTimeTs'=> 'string',
        'recvTime'=> 'string',
        'fiwareServicePath'=> 'string',
        'entityId'=> 'string',
        'entityType'=> 'string',
        'attrName'=> 'string',
        'attrType'=> 'string',
        'attrValue'=> 'string',
        'attrMd'=> 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];




}
