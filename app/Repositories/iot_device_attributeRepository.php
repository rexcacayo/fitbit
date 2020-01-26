<?php

namespace App\Repositories;

use App\Models\iot_device_attribute;
use App\Repositories\BaseRepository;

/**
 * Class iot_device_attributeRepository
 * @package App\Repositories
 * @version June 2, 2019, 2:41 pm UTC
*/

class iot_device_attributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type'
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
        return iot_device_attribute::class;
    }
}
