<?php

namespace App\Repositories;

use App\Models\heartInterDay;
use App\Repositories\BaseRepository;

/**
 * Class heartInterDayRepository
 * @package App\Repositories
 * @version November 28, 2019, 2:52 pm UTC
*/

class heartInterDayRepository extends BaseRepository
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
        return heartInterDay::class;
    }
}
