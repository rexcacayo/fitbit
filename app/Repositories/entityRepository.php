<?php

namespace App\Repositories;

use App\Models\entity;
use App\Repositories\BaseRepository;

/**
 * Class entityRepository
 * @package App\Repositories
 * @version May 26, 2019, 10:31 am UTC
*/

class entityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'entityID',
        'typeEntity'
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
        return entity::class;
    }
}
