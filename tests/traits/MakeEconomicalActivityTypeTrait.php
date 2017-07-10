<?php

use Faker\Factory as Faker;
use App\Models\EconomicalActivityType;
use App\Repositories\EconomicalActivityTypeRepository;

trait MakeEconomicalActivityTypeTrait
{
    /**
     * Create fake instance of EconomicalActivityType and save it in database
     *
     * @param array $economicalActivityTypeFields
     * @return EconomicalActivityType
     */
    public function makeEconomicalActivityType($economicalActivityTypeFields = [])
    {
        /** @var EconomicalActivityTypeRepository $economicalActivityTypeRepo */
        $economicalActivityTypeRepo = App::make(EconomicalActivityTypeRepository::class);
        $theme = $this->fakeEconomicalActivityTypeData($economicalActivityTypeFields);
        return $economicalActivityTypeRepo->create($theme);
    }

    /**
     * Get fake instance of EconomicalActivityType
     *
     * @param array $economicalActivityTypeFields
     * @return EconomicalActivityType
     */
    public function fakeEconomicalActivityType($economicalActivityTypeFields = [])
    {
        return new EconomicalActivityType($this->fakeEconomicalActivityTypeData($economicalActivityTypeFields));
    }

    /**
     * Get fake data of EconomicalActivityType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEconomicalActivityTypeData($economicalActivityTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'internalCode' => $fake->word,
            'nameEn' => $fake->word,
            'nameRu' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $economicalActivityTypeFields);
    }
}
