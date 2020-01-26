<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class entity
 * @package App\Models
 * @version May 26, 2019, 10:31 am UTC
 *
 * @property string ipServer
 * @property string fiwareService
 * @property string fiwarePath
 * @property string entityID
 * @property string typeEntity
 */
class entity extends Model
{
    use SoftDeletes;

    public $table = 'entities';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'entityID',
        'typeEntity'
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
        'entityID' => 'string',
        'typeEntity' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ipServer' => 'required',
        'fiwareService' => 'required',
        'fiwarePath' => 'required',
        'entityID' => 'required|unique:entities',
        'typeEntity' => 'required'
    ];

    public function atributo()

    {

        return $this->hasMany('App\Models\atribute');

    }

    
}
