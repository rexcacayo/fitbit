<?php

namespace App\Repositories;

use App\Models\fitbit;
use App\Repositories\BaseRepository;

/**
 * Class fitbitRepository
 * @package App\Repositories
 * @version June 19, 2019, 5:42 pm UTC
*/

class fitbitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'token',
        'user_id',
        'name',
        'datebirth',
        'age',
        'continent',
        'country',
        'city',
        'dock',
        'avilable'
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
        return fitbit::class;
    }
}
