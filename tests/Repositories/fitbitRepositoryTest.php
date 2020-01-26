<?php namespace Tests\Repositories;

use App\Models\fitbit;
use App\Repositories\fitbitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakefitbitTrait;
use Tests\ApiTestTrait;

class fitbitRepositoryTest extends TestCase
{
    use MakefitbitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var fitbitRepository
     */
    protected $fitbitRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->fitbitRepo = \App::make(fitbitRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_fitbit()
    {
        $fitbit = $this->fakefitbitData();
        $createdfitbit = $this->fitbitRepo->create($fitbit);
        $createdfitbit = $createdfitbit->toArray();
        $this->assertArrayHasKey('id', $createdfitbit);
        $this->assertNotNull($createdfitbit['id'], 'Created fitbit must have id specified');
        $this->assertNotNull(fitbit::find($createdfitbit['id']), 'fitbit with given id must be in DB');
        $this->assertModelData($fitbit, $createdfitbit);
    }

    /**
     * @test read
     */
    public function test_read_fitbit()
    {
        $fitbit = $this->makefitbit();
        $dbfitbit = $this->fitbitRepo->find($fitbit->id);
        $dbfitbit = $dbfitbit->toArray();
        $this->assertModelData($fitbit->toArray(), $dbfitbit);
    }

    /**
     * @test update
     */
    public function test_update_fitbit()
    {
        $fitbit = $this->makefitbit();
        $fakefitbit = $this->fakefitbitData();
        $updatedfitbit = $this->fitbitRepo->update($fakefitbit, $fitbit->id);
        $this->assertModelData($fakefitbit, $updatedfitbit->toArray());
        $dbfitbit = $this->fitbitRepo->find($fitbit->id);
        $this->assertModelData($fakefitbit, $dbfitbit->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_fitbit()
    {
        $fitbit = $this->makefitbit();
        $resp = $this->fitbitRepo->delete($fitbit->id);
        $this->assertTrue($resp);
        $this->assertNull(fitbit::find($fitbit->id), 'fitbit should not exist in DB');
    }
}
