<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class fiware
 * @package App\Models
 * @version May 19, 2019, 4:45 pm UTC
 *
 * @property string ipServer
 * @property string fiwareService
 * @property string fiwarePath
 * @property string description
 */
class fiware extends Model
{
    use SoftDeletes;

    public $table = 'fiware';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'recvTimeTs',
        'recvTime',
        'fiwareServicePath',
        'entityId',
        'entityType',
        'attrName',
        'attrType',
        'attrValue',
        'attrMd'
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
        'fiwarePath' => 'required',
        'transmisor' => 'required',
    ];

    public static function nombreTabla($tb){
        $table = $tb;
        $datos = DB::table($table);
        return $datos;
    }



}
