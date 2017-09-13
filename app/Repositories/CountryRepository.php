<?php

namespace App\Repositories;

use App\Models\Country;
use InfyOm\Generator\Common\BaseRepository;

class CountryRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Country::class;
    }

    public function allForDropDown()
    {
        $countries = Country::all();

        $result = [];
        foreach ($countries as $country) {
            $result[$country->_id->getData()] = $country->names['en'] . ' / ' . $country->names['ru'];
        }

        return $result;
    }
}
