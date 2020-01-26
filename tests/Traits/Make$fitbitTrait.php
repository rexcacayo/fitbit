<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\$fitbit;
use App\Repositories\$fitbitRepository;

trait Make$fitbitTrait
{
    /**
     * Create fake instance of $fitbit and save it in database
     *
     * @param array $$fitbitFields
     * @return $fitbit
     */
    public function make$fitbit($$fitbitFields = [])
    {
        /** @var $fitbitRepository $$fitbitRepo */
        $$fitbitRepo = \App::make($fitbitRepository::class);
        $theme = $this->fake$fitbitData($$fitbitFields);
        return $$fitbitRepo->create($theme);
    }

    /**
     * Get fake instance of $fitbit
     *
     * @param array $$fitbitFields
     * @return $fitbit
     */
    public function fake$fitbit($$fitbitFields = [])
    {
        return new $fitbit($this->fake$fitbitData($$fitbitFields));
    }

    /**
     * Get fake data of $fitbit
     *
     * @param array $$fitbitFields
     * @return array
     */
    public function fake$fitbitData($$fitbitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'token' => $fake->word,
            'user_id' => $fake->word,
            'nombrecompleto' => $fake->word,
            'fechanacimiento' => $fake->word,
            'edad' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $$fitbitFields);
    }
}
