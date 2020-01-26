<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class sleep
 * @package App\Models
 * @version December 2, 2019, 2:10 pm UTC
 *
 */
class sleep extends Model
{
    use SoftDeletes;

    public $table = 'sleeps';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
