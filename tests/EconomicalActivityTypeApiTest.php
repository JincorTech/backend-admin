<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EconomicalActivityTypeApiTest extends TestCase
{
    use MakeEconomicalActivityTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateEconomicalActivityType()
    {
        $economicalActivityType = $this->fakeEconomicalActivityTypeData();
        $this->json('POST', '/api/v1/economicalActivityTypes', $economicalActivityType);

        $this->assertApiResponse($economicalActivityType);
    }

    /**
     * @test
     */
    public function testReadEconomicalActivityType()
    {
        $economicalActivityType = $this->makeEconomicalActivityType();
        $this->json('GET', '/api/v1/economicalActivityTypes/'.$economicalActivityType->id);

        $this->assertApiResponse($economicalActivityType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateEconomicalActivityType()
    {
        $economicalActivityType = $this->makeEconomicalActivityType();
        $editedEconomicalActivityType = $this->fakeEconomicalActivityTypeData();

        $this->json('PUT', '/api/v1/economicalActivityTypes/'.$economicalActivityType->id, $editedEconomicalActivityType);

        $this->assertApiResponse($editedEconomicalActivityType);
    }

    /**
     * @test
     */
    public function testDeleteEconomicalActivityType()
    {
        $economicalActivityType = $this->makeEconomicalActivityType();
        $this->json('DELETE', '/api/v1/economicalActivityTypes/'.$economicalActivityType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/economicalActivityTypes/'.$economicalActivityType->id);

        $this->assertResponseStatus(404);
    }
}
