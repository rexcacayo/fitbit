<?php

namespace App\Repositories;

use App\Models\iotService;
use App\Repositories\BaseRepository;

/**
 * Class iotServiceRepository
 * @package App\Repositories
 * @version June 1, 2019, 5:02 pm UTC
*/

class iotServiceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'apikey',
        'cbroker',
        'entity_type',
        'resource'
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
        return iotService::class;
    }
}
