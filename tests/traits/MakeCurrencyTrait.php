<?php

use Faker\Factory as Faker;
use App\Models\Currency;
use App\Repositories\CurrencyRepository;

trait MakeCurrencyTrait
{
    /**
     * Create fake instance of Currency and save it in database
     *
     * @param array $currencyFields
     * @return Currency
     */
    public function makeCurrency($currencyFields = [])
    {
        /** @var CurrencyRepository $currencyRepo */
        $currencyRepo = App::make(CurrencyRepository::class);
        $theme = $this->fakeCurrencyData($currencyFields);
        return $currencyRepo->create($theme);
    }

    /**
     * Get fake instance of Currency
     *
     * @param array $currencyFields
     * @return Currency
     */
    public function fakeCurrency($currencyFields = [])
    {
        return new Currency($this->fakeCurrencyData($currencyFields));
    }

    /**
     * Get fake data of Currency
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCurrencyData($currencyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nameEn' => $fake->word,
            'nameRu' => $fake->word,
            'alpha3Code' => $fake->word,
            'numericCode' => $fake->word,
            'sign' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $currencyFields);
    }
}
