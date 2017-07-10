<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CurrencyApiTest extends TestCase
{
    use MakeCurrencyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCurrency()
    {
        $currency = $this->fakeCurrencyData();
        $this->json('POST', '/api/v1/currencies', $currency);

        $this->assertApiResponse($currency);
    }

    /**
     * @test
     */
    public function testReadCurrency()
    {
        $currency = $this->makeCurrency();
        $this->json('GET', '/api/v1/currencies/'.$currency->id);

        $this->assertApiResponse($currency->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCurrency()
    {
        $currency = $this->makeCurrency();
        $editedCurrency = $this->fakeCurrencyData();

        $this->json('PUT', '/api/v1/currencies/'.$currency->id, $editedCurrency);

        $this->assertApiResponse($editedCurrency);
    }

    /**
     * @test
     */
    public function testDeleteCurrency()
    {
        $currency = $this->makeCurrency();
        $this->json('DELETE', '/api/v1/currencies/'.$currency->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/currencies/'.$currency->id);

        $this->assertResponseStatus(404);
    }
}
