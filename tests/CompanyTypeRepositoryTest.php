<?php

use App\Models\CompanyType;
use App\Repositories\CompanyTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTypeRepositoryTest extends TestCase
{
    use MakeCompanyTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CompanyTypeRepository
     */
    protected $companyTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->companyTypeRepo = App::make(CompanyTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCompanyType()
    {
        $companyType = $this->fakeCompanyTypeData();
        $createdCompanyType = $this->companyTypeRepo->create($companyType);
        $createdCompanyType = $createdCompanyType->toArray();
        $this->assertArrayHasKey('id', $createdCompanyType);
        $this->assertNotNull($createdCompanyType['id'], 'Created CompanyType must have id specified');
        $this->assertNotNull(CompanyType::find($createdCompanyType['id']), 'CompanyType with given id must be in DB');
        $this->assertModelData($companyType, $createdCompanyType);
    }

    /**
     * @test read
     */
    public function testReadCompanyType()
    {
        $companyType = $this->makeCompanyType();
        $dbCompanyType = $this->companyTypeRepo->find($companyType->id);
        $dbCompanyType = $dbCompanyType->toArray();
        $this->assertModelData($companyType->toArray(), $dbCompanyType);
    }

    /**
     * @test update
     */
    public function testUpdateCompanyType()
    {
        $companyType = $this->makeCompanyType();
        $fakeCompanyType = $this->fakeCompanyTypeData();
        $updatedCompanyType = $this->companyTypeRepo->update($fakeCompanyType, $companyType->id);
        $this->assertModelData($fakeCompanyType, $updatedCompanyType->toArray());
        $dbCompanyType = $this->companyTypeRepo->find($companyType->id);
        $this->assertModelData($fakeCompanyType, $dbCompanyType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCompanyType()
    {
        $companyType = $this->makeCompanyType();
        $resp = $this->companyTypeRepo->delete($companyType->id);
        $this->assertTrue($resp);
        $this->assertNull(CompanyType::find($companyType->id), 'CompanyType should not exist in DB');
    }
}
