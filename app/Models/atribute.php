<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class atribute
 * @package App\Models
 * @version May 26, 2019, 10:33 am UTC
 *
 * @property string name
 * @property string type
 * @property string value
 * @property integer entity_id
 */
class atribute extends Model
{
    use SoftDeletes;

    public $table = 'atributes';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'type',
        'value',
        'entity_id'
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
        'value' => 'string',
        'entity_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function iotservice()
    {
        return $this->belongsTo('App\iotService', 'entity_id', 'id');
    }


}
