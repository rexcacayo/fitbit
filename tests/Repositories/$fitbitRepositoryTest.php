<?php namespace Tests\Repositories;

use App\Models\$fitbit;
use App\Repositories\$fitbitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\Make$fitbitTrait;
use Tests\ApiTestTrait;

class $fitbitRepositoryTest extends TestCase
{
    use Make$fitbitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var $fitbitRepository
     */
    protected $$fitbitRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->$fitbitRepo = \App::make($fitbitRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_$fitbit()
    {
        $$fitbit = $this->fake$fitbitData();
        $created$fitbit = $this->$fitbitRepo->create($$fitbit);
        $created$fitbit = $created$fitbit->toArray();
        $this->assertArrayHasKey('id', $created$fitbit);
        $this->assertNotNull($created$fitbit['id'], 'Created $fitbit must have id specified');
        $this->assertNotNull($fitbit::find($created$fitbit['id']), '$fitbit with given id must be in DB');
        $this->assertModelData($$fitbit, $created$fitbit);
    }

    /**
     * @test read
     */
    public function test_read_$fitbit()
    {
        $$fitbit = $this->make$fitbit();
        $db$fitbit = $this->$fitbitRepo->find($$fitbit->id);
        $db$fitbit = $db$fitbit->toArray();
        $this->assertModelData($$fitbit->toArray(), $db$fitbit);
    }

    /**
     * @test update
     */
    public function test_update_$fitbit()
    {
        $$fitbit = $this->make$fitbit();
        $fake$fitbit = $this->fake$fitbitData();
        $updated$fitbit = $this->$fitbitRepo->update($fake$fitbit, $$fitbit->id);
        $this->assertModelData($fake$fitbit, $updated$fitbit->toArray());
        $db$fitbit = $this->$fitbitRepo->find($$fitbit->id);
        $this->assertModelData($fake$fitbit, $db$fitbit->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_$fitbit()
    {
        $$fitbit = $this->make$fitbit();
        $resp = $this->$fitbitRepo->delete($$fitbit->id);
        $this->assertTrue($resp);
        $this->assertNull($fitbit::find($$fitbit->id), '$fitbit should not exist in DB');
    }
}
