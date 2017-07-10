<?php

use Faker\Factory as Faker;
use App\Models\CompanyType;
use App\Repositories\CompanyTypeRepository;

trait MakeCompanyTypeTrait
{
    /**
     * Create fake instance of CompanyType and save it in database
     *
     * @param array $companyTypeFields
     * @return CompanyType
     */
    public function makeCompanyType($companyTypeFields = [])
    {
        /** @var CompanyTypeRepository $companyTypeRepo */
        $companyTypeRepo = App::make(CompanyTypeRepository::class);
        $theme = $this->fakeCompanyTypeData($companyTypeFields);
        return $companyTypeRepo->create($theme);
    }

    /**
     * Get fake instance of CompanyType
     *
     * @param array $companyTypeFields
     * @return CompanyType
     */
    public function fakeCompanyType($companyTypeFields = [])
    {
        return new CompanyType($this->fakeCompanyTypeData($companyTypeFields));
    }

    /**
     * Get fake data of CompanyType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCompanyTypeData($companyTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'code' => $fake->word,
            'nameEn' => $fake->word,
            'nameRu' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $companyTypeFields);
    }
}
