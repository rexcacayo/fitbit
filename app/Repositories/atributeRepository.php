<?php

namespace App\Repositories;

use App\Models\atribute;
use App\Repositories\BaseRepository;

/**
 * Class atributeRepository
 * @package App\Repositories
 * @version May 26, 2019, 10:33 am UTC
*/

class atributeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'type',
        'value'
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
        return atribute::class;
    }
}
