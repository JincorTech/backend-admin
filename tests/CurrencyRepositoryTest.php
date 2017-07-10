<?php

use App\Models\Currency;
use App\Repositories\CurrencyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CurrencyRepositoryTest extends TestCase
{
    use MakeCurrencyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CurrencyRepository
     */
    protected $currencyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->currencyRepo = App::make(CurrencyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCurrency()
    {
        $currency = $this->fakeCurrencyData();
        $createdCurrency = $this->currencyRepo->create($currency);
        $createdCurrency = $createdCurrency->toArray();
        $this->assertArrayHasKey('id', $createdCurrency);
        $this->assertNotNull($createdCurrency['id'], 'Created Currency must have id specified');
        $this->assertNotNull(Currency::find($createdCurrency['id']), 'Currency with given id must be in DB');
        $this->assertModelData($currency, $createdCurrency);
    }

    /**
     * @test read
     */
    public function testReadCurrency()
    {
        $currency = $this->makeCurrency();
        $dbCurrency = $this->currencyRepo->find($currency->id);
        $dbCurrency = $dbCurrency->toArray();
        $this->assertModelData($currency->toArray(), $dbCurrency);
    }

    /**
     * @test update
     */
    public function testUpdateCurrency()
    {
        $currency = $this->makeCurrency();
        $fakeCurrency = $this->fakeCurrencyData();
        $updatedCurrency = $this->currencyRepo->update($fakeCurrency, $currency->id);
        $this->assertModelData($fakeCurrency, $updatedCurrency->toArray());
        $dbCurrency = $this->currencyRepo->find($currency->id);
        $this->assertModelData($fakeCurrency, $dbCurrency->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCurrency()
    {
        $currency = $this->makeCurrency();
        $resp = $this->currencyRepo->delete($currency->id);
        $this->assertTrue($resp);
        $this->assertNull(Currency::find($currency->id), 'Currency should not exist in DB');
    }
}
