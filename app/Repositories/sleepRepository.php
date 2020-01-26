<?php

namespace App\Repositories;

use App\Models\sleep;
use App\Repositories\BaseRepository;

/**
 * Class sleepRepository
 * @package App\Repositories
 * @version December 2, 2019, 2:10 pm UTC
*/

class sleepRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return sleep::class;
    }
}
