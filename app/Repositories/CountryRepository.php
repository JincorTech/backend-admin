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

}
