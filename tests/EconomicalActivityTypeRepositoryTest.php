<?php

use App\Models\EconomicalActivityType;
use App\Repositories\EconomicalActivityTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EconomicalActivityTypeRepositoryTest extends TestCase
{
    use MakeEconomicalActivityTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EconomicalActivityTypeRepository
     */
    protected $economicalActivityTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->economicalActivityTypeRepo = App::make(EconomicalActivityTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateEconomicalActivityType()
    {
        $economicalActivityType = $this->fakeEconomicalActivityTypeData();
        $createdEconomicalActivityType = $this->economicalActivityTypeRepo->create($economicalActivityType);
        $createdEconomicalActivityType = $createdEconomicalActivityType->toArray();
        $this->assertArrayHasKey('id', $createdEconomicalActivityType);
        $this->assertNotNull($createdEconomicalActivityType['id'], 'Created EconomicalActivityType must have id specified');
        $this->assertNotNull(EconomicalActivityType::find($createdEconomicalActivityType['id']), 'EconomicalActivityType with given id must be in DB');
        $this->assertModelData($economicalActivityType, $createdEconomicalActivityType);
    }

    /**
     * @test read
     */
    public function testReadEconomicalActivityType()
    {
        $economicalActivityType = $this->makeEconomicalActivityType();
        $dbEconomicalActivityType = $this->economicalActivityTypeRepo->find($economicalActivityType->id);
        $dbEconomicalActivityType = $dbEconomicalActivityType->toArray();
        $this->assertModelData($economicalActivityType->toArray(), $dbEconomicalActivityType);
    }

    /**
     * @test update
     */
    public function testUpdateEconomicalActivityType()
    {
        $economicalActivityType = $this->makeEconomicalActivityType();
        $fakeEconomicalActivityType = $this->fakeEconomicalActivityTypeData();
        $updatedEconomicalActivityType = $this->economicalActivityTypeRepo->update($fakeEconomicalActivityType, $economicalActivityType->id);
        $this->assertModelData($fakeEconomicalActivityType, $updatedEconomicalActivityType->toArray());
        $dbEconomicalActivityType = $this->economicalActivityTypeRepo->find($economicalActivityType->id);
        $this->assertModelData($fakeEconomicalActivityType, $dbEconomicalActivityType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteEconomicalActivityType()
    {
        $economicalActivityType = $this->makeEconomicalActivityType();
        $resp = $this->economicalActivityTypeRepo->delete($economicalActivityType->id);
        $this->assertTrue($resp);
        $this->assertNull(EconomicalActivityType::find($economicalActivityType->id), 'EconomicalActivityType should not exist in DB');
    }
}
