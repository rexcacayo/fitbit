<?php

namespace App\Repositories;

use App\Models\fiware;
use App\Repositories\BaseRepository;

/**
 * Class notifyRepository
 * @package App\Repositories
 * @version May 19, 2019, 4:45 pm UTC
*/

class fiwareRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'recvTimeTs',
        'recvTime',
        'fiwareServicePath',
        'entityId',
        'entityType',
        'attrName',
        'attrType',
        'attrValue',
        'attrMd'
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
        return fiware::class;
    }
}
