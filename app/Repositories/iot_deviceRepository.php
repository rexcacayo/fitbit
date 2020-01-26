<?php

namespace App\Repositories;

use App\Models\iot_device;
use App\Repositories\BaseRepository;

/**
 * Class iot_deviceRepository
 * @package App\Repositories
 * @version June 2, 2019, 2:31 pm UTC
*/

class iot_deviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'device_id',
        'entity_name',
        'entity_type'
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
        return iot_device::class;
    }
}
