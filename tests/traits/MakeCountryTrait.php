<?php

use Faker\Factory as Faker;
use App\Models\Country;
use App\Repositories\CountryRepository;

trait MakeCountryTrait
{
    /**
     * Create fake instance of Country and save it in database
     *
     * @param array $countryFields
     * @return Country
     */
    public function makeCountry($countryFields = [])
    {
        /** @var CountryRepository $countryRepo */
        $countryRepo = App::make(CountryRepository::class);
        $theme = $this->fakeCountryData($countryFields);
        return $countryRepo->create($theme);
    }

    /**
     * Get fake instance of Country
     *
     * @param array $countryFields
     * @return Country
     */
    public function fakeCountry($countryFields = [])
    {
        return new Country($this->fakeCountryData($countryFields));
    }

    /**
     * Get fake data of Country
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCountryData($countryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nameEn' => $fake->word,
            'nameRu' => $fake->word,
            'phoneCode' => $fake->word,
            'ISO2Code' => $fake->word,
            'numericCode' => $fake->word,
            'alpha2Code' => $fake->word,
            'Alpha3Code' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $countryFields);
    }
}
