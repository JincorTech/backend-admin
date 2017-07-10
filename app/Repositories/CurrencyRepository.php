<?php

namespace App\Repositories;

use App\Models\Currency;
use InfyOm\Generator\Common\BaseRepository;

class CurrencyRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Currency::class;
    }

    public function getAllForDropdown()
    {
        $allCurrencies = $this->all();

        $result = [];

        foreach ($allCurrencies as $currency) {
            /**
             * @var $type Currency
             */
            $result[$currency->_id->getData()] = $currency->ISOCodes['alpha3Code'] . ': ' . $currency->names['en'] . ' / ' . $currency->names['ru'];
        }
        return $result;
    }
}
