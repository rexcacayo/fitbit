<?php

namespace App\Repositories;

use App\Models\heartRate;
use App\Repositories\BaseRepository;

/**
 * Class heartRateRepository
 * @package App\Repositories
 * @version November 28, 2019, 9:10 am UTC
*/

class heartRateRepository extends BaseRepository
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
        return heartRate::class;
    }
}
