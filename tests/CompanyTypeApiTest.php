<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTypeApiTest extends TestCase
{
    use MakeCompanyTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCompanyType()
    {
        $companyType = $this->fakeCompanyTypeData();
        $this->json('POST', '/api/v1/companyTypes', $companyType);

        $this->assertApiResponse($companyType);
    }

    /**
     * @test
     */
    public function testReadCompanyType()
    {
        $companyType = $this->makeCompanyType();
        $this->json('GET', '/api/v1/companyTypes/'.$companyType->id);

        $this->assertApiResponse($companyType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCompanyType()
    {
        $companyType = $this->makeCompanyType();
        $editedCompanyType = $this->fakeCompanyTypeData();

        $this->json('PUT', '/api/v1/companyTypes/'.$companyType->id, $editedCompanyType);

        $this->assertApiResponse($editedCompanyType);
    }

    /**
     * @test
     */
    public function testDeleteCompanyType()
    {
        $companyType = $this->makeCompanyType();
        $this->json('DELETE', '/api/v1/companyTypes/'.$companyType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/companyTypes/'.$companyType->id);

        $this->assertResponseStatus(404);
    }
}
