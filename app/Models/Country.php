<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\BSON\Binary;
use Ramsey\Uuid\Uuid;

/**
 * Class Country
 * @package App\Models
 * @version July 10, 2017, 9:21 am UTC
 */
class Country extends Model
{
    protected $collection = 'countries';
    
    protected $fillable = [
        'names',
        'phoneCode',
        'ISOCodes',
        'currency',
    ];

    public $timestamps = false;

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'names.en' => 'required',
        'names.ru' => 'required',
        'phoneCode' => 'required',
        'ISOCodes.ISO2Code' => 'required',
        'ISOCodes.numericCode' => 'required|integer|min:1|max:999',
        'ISOCodes.alpha2Code' => 'required|size:2|regex:/[A-Z]/',
        'ISOCodes.alpha3Code' => 'required|size:3|regex:/[A-Z]/',
    ];

    public function newInstance($attributes = [], $exists = false)
    {
        $model = parent::newInstance($attributes, $exists);
        $model->_id = new Binary(Uuid::uuid4(), Binary::TYPE_OLD_UUID);
        return $model;
    }

    public function setCurrencyAttribute($value)
    {
        $this->attributes['currency'] = [
            '_bsontype' => 'DBRef',
            '$ref' => 'currencies',
            '$id' => new Binary($value, Binary::TYPE_OLD_UUID),
            '$db' => env('DB_DATABASE'),
        ];
    }

    public function getCurrencyAttribute($value)
    {
        return $value['$id'];
    }

    public function getCurrency()
    {
        return Currency::find($this->currency);
    }

    public function toArray()
    {
        $result = parent::toArray();
        $result['currency'] = $this->currency->getData();
        return $result;
    }
}
