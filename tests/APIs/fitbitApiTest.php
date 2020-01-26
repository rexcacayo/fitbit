<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakefitbitTrait;
use Tests\ApiTestTrait;

class fitbitApiTest extends TestCase
{
    use MakefitbitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_fitbit()
    {
        $fitbit = $this->fakefitbitData();
        $this->response = $this->json('POST', '/api/fitbits', $fitbit);

        $this->assertApiResponse($fitbit);
    }

    /**
     * @test
     */
    public function test_read_fitbit()
    {
        $fitbit = $this->makefitbit();
        $this->response = $this->json('GET', '/api/fitbits/'.$fitbit->id);

        $this->assertApiResponse($fitbit->toArray());
    }

    /**
     * @test
     */
    public function test_update_fitbit()
    {
        $fitbit = $this->makefitbit();
        $editedfitbit = $this->fakefitbitData();

        $this->response = $this->json('PUT', '/api/fitbits/'.$fitbit->id, $editedfitbit);

        $this->assertApiResponse($editedfitbit);
    }

    /**
     * @test
     */
    public function test_delete_fitbit()
    {
        $fitbit = $this->makefitbit();
        $this->response = $this->json('DELETE', '/api/fitbits/'.$fitbit->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/fitbits/'.$fitbit->id);

        $this->response->assertStatus(404);
    }
}
