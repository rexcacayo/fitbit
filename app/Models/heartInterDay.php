<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class heartInterDay
 * @package App\Models
 * @version November 28, 2019, 2:52 pm UTC
 *
 */
class heartInterDay extends Model
{
    //use SoftDeletes;

    public $table = 'urn_ngsi-Id_Diary_Diary';


    protected $dates = ['deleted_at'];



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
