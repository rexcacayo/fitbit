<?php

namespace App\Repositories;

use App\Models\notify;
use App\Repositories\BaseRepository;

/**
 * Class notifyRepository
 * @package App\Repositories
 * @version May 19, 2019, 4:45 pm UTC
*/

class notifyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ipServer',
        'fiwareService',
        'fiwarePath',
        'description'
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
        return notify::class;
    }
}
