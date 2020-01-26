<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\fitbit;
use App\Repositories\fitbitRepository;

trait MakefitbitTrait
{
    /**
     * Create fake instance of fitbit and save it in database
     *
     * @param array $fitbitFields
     * @return fitbit
     */
    public function makefitbit($fitbitFields = [])
    {
        /** @var fitbitRepository $fitbitRepo */
        $fitbitRepo = \App::make(fitbitRepository::class);
        $theme = $this->fakefitbitData($fitbitFields);
        return $fitbitRepo->create($theme);
    }

    /**
     * Get fake instance of fitbit
     *
     * @param array $fitbitFields
     * @return fitbit
     */
    public function fakefitbit($fitbitFields = [])
    {
        return new fitbit($this->fakefitbitData($fitbitFields));
    }

    /**
     * Get fake data of fitbit
     *
     * @param array $fitbitFields
     * @return array
     */
    public function fakefitbitData($fitbitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'token' => $fake->word,
            'user_id' => $fake->word,
            'name' => $fake->word,
            'datebirth' => $fake->word,
            'age' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $fitbitFields);
    }
}
